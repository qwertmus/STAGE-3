function calculateAffordability(event) {
    event.preventDefault(); // Prevent form submission

    // Get the input values
    let income = parseFloat(document.getElementById("income").value);
    let expenditure = parseFloat(document.getElementById("expenditure").value);

    // Calculate affordability
    let affordability = (income - expenditure) * 4;

    // Display the result
    alert("Your affordability is: £" + affordability.toFixed(2));
}