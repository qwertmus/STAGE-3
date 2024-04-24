function comparisonvalidation() {
    var quote1 = document.getElementById('compare1').value;
    var quote2 = document.getElementById('compare2').value;
    if (!quote1 || !quote2) {
        alert("You must select 2 quotes to compare.");
        return false;
    }
    return true;
}