function editData(index) {
    let row = document.querySelectorAll("tbody tr")[index];
    let cells = row.querySelectorAll("td[contenteditable]");
    cells.forEach(cell => cell.contentEditable = "true");
    alert("تم تفعيل وضع تصحيح البيانات للصف " + (index + 1));
  }
  
  function confirmData(index) {
    let row = document.querySelectorAll("tbody tr")[index];
    let cells = row.querySelectorAll("td[contenteditable]");
    cells.forEach(cell => cell.contentEditable = "false");
    alert("تم تأكيد البيانات للصف " + (index + 1));
  }
  <button onclick="window.location.href='nextpage.html';">Go to Next Page</button>
