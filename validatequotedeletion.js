function validatedeletion(quoteId) {
    if (confirm("Are you sure you would like to delete this quote?")) {
        document.querySelector('form[action="deletequote.php"]').submit();
    } else {
        return false;
    }
}