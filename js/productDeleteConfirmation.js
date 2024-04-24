function ConfirmDeletion(id) {
    let confirmDeletion = document.getElementById("confirmation");
    let hiddenValue = document.querySelector("#confirmation input");
    
    confirmDeletion.hidden = false;
    hiddenValue.value = id.id;
}
