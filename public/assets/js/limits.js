$(document).ready(function() {
    const limitInput = $('#limit');
    const limitCheckbox = $('#limitCheckbox');


    limitCheckbox.on('change', function () {
       $(this).is(':checked') ? limitInput.prop('disabled', false) : (limitInput.prop('disabled', true) && $('#limit').val(""));

})


});


const getLimitForCategory = async (category) => {
    try {
        const res = await fetch(`../api/limit/${category}`);
        const data = await res.json();
        return data.spend_limit;
    } catch (e) {
        console.error("Error: ", e);
    }
}

const getSpendsForCategory = async (category, date) => {
    try {
        const res = await fetch(`../api/spends/${category}/${date}`);
        const data = await res.json();
        return data.value;
    } catch (e) {
        console.error("Error: ", e);
    }
}

const showLimitState = async (category, date) => {
    try {
        if (!category || category === "Select an expense category") {
            return;
        }

        const limit = await getLimitForCategory(category);
        const spends = await getSpendsForCategory(category, date);
        const categoryName  = $('.expenseCategories option:selected').text();
        let amount = $('#amount').val() === '' ? 0 : $('#amount').val();
        let leftToSpend = parseFloat(limit) - parseFloat(spends) - parseFloat(amount);
        
        const divSetLimit = `
        <div>
            <div>Limit to spend this month on ${categoryName} is: ${limit} PLN</div>
            <div>This month You spent ${spends} PLN on ${categoryName}</div>
            <div class="${leftToSpend > 0 ? 'text-success' : 'text-danger'}">Left to spend: ${leftToSpend} PLN</div>
        </div>
    `;

    const divUnsetLimit = `<div>${categoryName} has no set limits</div>`;


    if ($('#limitBox .limitDiv').length > 0) {

        $('.limitDiv').html(limit !== null ? divSetLimit : divUnsetLimit);
    } else {
        $('#limitBox').append($(`<div class="limitDiv p-5">${limit !== null ? divSetLimit : divUnsetLimit}</div>`));
    }
        
    } catch (e) {
        console.error("Error: ", e);
    }

}

$('.expenseCategories, #date, #amount').on('change', async function() {
    const selectedCategory = $('.expenseCategories').val();
    const date = $('#date').val();

    await showLimitState(selectedCategory, date);
  });