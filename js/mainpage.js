function calculateAffordability(event) {
    event.preventDefault(); // Prevent form submission

    // Get the input values
    let income = parseFloat(document.getElementById("income").value);
    let expenditure = parseFloat(document.getElementById("expenditure").value);

    // Calculate affordability
    let affordability = (income - expenditure) * 4;

    // Display the result
    document.getElementById("result").innerHTML = "£ " + affordability.toFixed(2);
}

