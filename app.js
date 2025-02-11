// إعداد Firebase
const firebaseConfig = {
    apiKey: "YOUR_API_KEY",
    authDomain: "YOUR_AUTH_DOMAIN",
    projectId: "YOUR_PROJECT_ID",
    storageBucket: "YOUR_STORAGE_BUCKET",
    messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
    appId: "YOUR_APP_ID"
};

const app = firebase.initializeApp(firebaseConfig);
const db = firebase.firestore();

// إرسال تعليق إلى Firestore
function postComment(type) {
    let commentInput;
    let commentContainer;

    if (type === 'article') {
        commentInput = document.getElementById('commentInputArticle');
        commentContainer = document.getElementById('commentsArticle');
    } else if (type === 'image') {
        commentInput = document.getElementById('commentInputImage');
        commentContainer = document.getElementById('commentsImage');
    } else if (type === 'audio') {
        commentInput = document.getElementById('commentInputAudio');
        commentContainer = document.getElementById('commentsAudio');
    }

    if (commentInput.value.trim() !== "") {
        const comment = {
            text: commentInput.value,
            timestamp: firebase.firestore.FieldValue.serverTimestamp()
        };

        // حفظ التعليق في Firestore
        db.collection("comments").add(comment).then(() => {
            // إضافة التعليق إلى الصفحة
            let newComment = document.createElement('div');
            newComment.classList.add('comment');
            newComment.innerHTML = `<span class="anonymous">مجهول</span>: ${commentInput.value}`;
            commentContainer.appendChild(newComment);
            commentInput.value = "";
        }).catch(error => {
            console.error("خطأ في إضافة التعليق: ", error);
        });
    }
}

// جلب التعليقات من Firestore عند تحميل الصفحة
window.onload = function() {
    db.collection("comments").orderBy("timestamp", "desc").onSnapshot((snapshot) => {
        snapshot.forEach(doc => {
            const commentData = doc.data();
            const comment = document.createElement('div');
            comment.classList.add('comment');
            comment.innerHTML = `<span class="anonymous">مجهول</span>: ${commentData.text}`;
            document.getElementById('commentsArticle').appendChild(comment);
        });
    });
};
