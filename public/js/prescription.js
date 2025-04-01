// Handle amount inputs
document.querySelectorAll('input[name$="_amount"], input[name="total"], input[name="advance"], input[name="balance"]').forEach(input => {
    input.addEventListener('input', function(e) {
        // Remove non-numeric characters and convert to number
        let value = this.value.replace(/[^0-9]/g, '');
        
        // Format as currency
        if (value) {
            this.value = '₹ ' + parseInt(value).toLocaleString('en-IN');
        } else {
            this.value = '';
        }
        
        // Calculate total if this is an amount field
        if (this.name.endsWith('_amount')) {
            calculateTotal();
        }
        
        // Calculate balance if this is advance
        if (this.name === 'advance') {
            calculateBalance();
        }
    });
});

// Calculate total amount
function calculateTotal() {
    let total = 0;
    document.querySelectorAll('input[name$="_amount"]').forEach(input => {
        let value = input.value.replace(/[^0-9]/g, '');
        total += parseInt(value) || 0;
    });
    
    document.querySelector('input[name="total"]').value = '₹ ' + total.toLocaleString('en-IN');
    calculateBalance();
}

// Calculate balance
function calculateBalance() {
    let total = parseInt(document.querySelector('input[name="total"]').value.replace(/[^0-9]/g, '')) || 0;
    let advance = parseInt(document.querySelector('input[name="advance"]').value.replace(/[^0-9]/g, '')) || 0;
    let balance = total - advance;
    
    document.querySelector('input[name="balance"]').value = '₹ ' + balance.toLocaleString('en-IN');
}

// Handle mobiscroll select changes
document.querySelectorAll('.mobiscroll-select').forEach((select, index) => {
    select.addEventListener('change', function() {
        let input = document.querySelectorAll('.mobiscroll-input')[index];
        input.value = this.options[this.selectedIndex].text;
    });
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    let customerName = document.querySelector('input[name="customer_name"]').value;
    let mobileNumber = document.querySelector('input[name="mobile_number"]').value;
    let total = document.querySelector('input[name="total"]').value;

    if (!customerName) {
        e.preventDefault();
        alert('Please enter customer name');
        return;
    }

    if (!mobileNumber) {
        e.preventDefault();
        alert('Please enter mobile number');
        return;
    }

    if (!total || total === '₹ 0') {
        e.preventDefault();
        alert('Total amount cannot be zero');
        return;
    }
});

// Initialize date picker
if (typeof mobiscroll !== 'undefined') {
    mobiscroll.datepicker('input[name="date"]', {
        controls: ['date'],
        dateFormat: 'MM/DD/YYYY',
        touchUi: true
    });
}

// Initialize mobiscroll
mobiscroll.setOptions({
    locale: mobiscroll.localeEn,
    theme: 'ios',
    themeVariant: 'light'
});

// Initialize all mobiscroll selects
document.querySelectorAll('.mobiscroll-select').forEach((select, index) => {
    let input = document.querySelectorAll('.mobiscroll-input')[index];
    
    mobiscroll.select(select, {
        inputElement: input,
        touchUi: true,
        display: 'anchored'
    });
    
    input.addEventListener('click', function () {
        mobiscroll.getInst(select).open();
    });
}); 