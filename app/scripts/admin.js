function sendPost(id, status) {
	method = "post";
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", "adminpost.php");

    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "id");
    hiddenField.setAttribute("value", id);
    form.appendChild(hiddenField);

    hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "status");
    hiddenField.setAttribute("value", status);
    
    form.appendChild(hiddenField);

    document.body.appendChild(form);
    form.submit();
}