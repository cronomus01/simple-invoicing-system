console.log('test');


const customerList = document.getElementById('customer-list')
const customerInput = document.getElementById('customer-input')
const customerInputId = document.getElementById('customer-input-id')

/**
 *
 * @param {Array<HTMLLIElement>} customers
 */
function addClickEventOnCustomers(customers) {
    customers.forEach(customer => {
        customer.addEventListener('click', (e) => {
            setValueOfCustomerInput(e.target.innerText, e.target.dataset.id)
        })
    })
}

function setValueOfCustomerInput(customerName, customerId) {
    try {
        customerInput.value = customerName;
        customerInputId.value = customerId;
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

checkIfCustomerListIdIsNull();
