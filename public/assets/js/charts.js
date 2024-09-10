function generateRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function generateArrayOfColors(lengthOfArray) {
    const colors = [];
    for (let i = 0; i < lengthOfArray; i++) {
        colors.push(generateRandomColor());
    }
    return colors;
}

function insertNewChartsElements() {
    $("#charts").empty();

    $("#charts").append("<div><canvas id='Expenses' style='width:100%;max-width:700px; height: 250px;'></canvas></div><div><canvas id='Incomes' style='width:100%;max-width:700px; height: 250px;'></canvas></div>");
}

function drawCharts(incomeOperations = null, expenseOperations = null) {
    
    insertNewChartsElements();
        
        new Chart("Incomes", {
            type: "pie",
            data: {
              labels: incomeOperations.map(item => item.name),
              datasets: [{
                backgroundColor: generateArrayOfColors(incomeOperations.length),
                data: incomeOperations.map(item => item.value)
              }]
            },
            options: {
                title: {
                    display: true,
                    text: "Incomes"
                }
            }
          });

        new Chart("Expenses", {
            type: "pie",
            data: {
            labels: expenseOperations.map(item => item.name),
            datasets: [{
                backgroundColor: generateArrayOfColors(expenseOperations.length),
                data: expenseOperations.map(item => item.value)
            }]
            },
            options: {
                title: {
                    display: true,
                    text: "Expenses"
                }
            }
        });
}

function insertNewChartsElements() {
    $("#incomeChart, #expenseChart").empty();

    $("#incomeChart").append("<div><canvas id='Incomes' style='width:100%;max-width:700px; height: 250px;'></canvas></div>");
    $("#expenseChart").append("<div><canvas id='Expenses' style='width:100%;max-width:700px; height: 250px;'></canvas></div>");
}

drawCharts(incomeOperations, expenseOperations);