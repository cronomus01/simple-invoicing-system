console.log('test');


const customerList = document.getElementById('customer-list')
const customerInput = document.querySelectorAll('.customer-input')
const customerInputId = document.getElementById('customer-input-id')

/**
 *
 * @param {Array<HTMLLIElement>} customers
 */
function addClickEventOnCustomers(customers) {
    customers.forEach(customer => {
        customer.addEventListener('click', (e) => {
            setValueOfCustomerInput(e.target.innerText)
            setValueOfCustomerIdInput(e.target.dataset.id)
            setValueOfCustomerEmail(e.target.dataset.email)
        })
    })
}

function setValueOfCustomerInput(customerName) {
    try {
        customerInput.forEach(input => {
            input.value = customerName
        })
    }
    catch(err) {
        throw new Error('Customer input element is null check if the element has an id of customer-input')
    }
}

function checkIfCustomerListIdIsNull () {
    try {
        addClickEventOnCustomers(Array.from(customerList.children))
    }
    catch(err) {
        throw new Error('Customer list element is null check if the element has an id of customer-list')
    }
}

function setValueOfCustomerIdInput(customerId) {
    try {
        customerInputId.value = customerId;
    }
    catch(err) {
        throw new Error('Customer input element is null check if the element has an id of customer-input')
    }
}

function setValueOfCustomerEmail(customerEmail) {
    try {
        const customerInputEmail = document.querySelectorAll('.customer-input-email')

        customerInputEmail.forEach(input => {
            input.value = customerEmail;
        })
    }
    catch(err) {
        throw new Error('Customer input element is null check if the element has an id of customer-email')
    }
}

checkIfCustomerListIdIsNull();
