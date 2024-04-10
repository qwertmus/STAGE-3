function calculateAffordability(event) {
    event.preventDefault(); // Prevent form submission
  
    // Retrieve input values
    const interestRate = parseFloat(document.getElementById("interest").value);
    const propertyValue = parseFloat(document.getElementById("propertyvalue").value);
    const deposit = parseFloat(document.getElementById("deposit").value);
    const mortgageTerm = parseFloat(document.getElementById("mortgageterm").value);
  
    // Calculate monthly payment
    const monthlyPayment = calculateMonthlyPayment(interestRate, propertyValue, deposit, mortgageTerm);
  
    // Display result
    alert("Monthly Payment: £" + monthlyPayment.toFixed(2));
  }
  
  function calculateMonthlyPayment(interestRate, propertyValue, deposit, mortgageTerm) {
    // Convert annual interest rate to monthly and adjust for percentage
    const monthlyInterestRate = (interestRate / 100) / 12;
  
    // Calculate the principal amount (loan amount)
    const principal = propertyValue - deposit;
  
    // Calculate the number of payments (total months)
    const numberOfPayments = mortgageTerm * 12;
  
    // Calculate the monthly payment using the formula
    const monthlyPayment = principal * (monthlyInterestRate * Math.pow(1 + monthlyInterestRate, numberOfPayments)) / (Math.pow(1 + monthlyInterestRate, numberOfPayments) - 1);
  
    return monthlyPayment;
  }