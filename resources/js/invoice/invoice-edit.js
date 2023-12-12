const clickButtonEl = document.getElementById('edit-button');
const modal = document.getElementById('modal');
const cancelButtonEl = document.getElementById('cancel');
const saveButtonEl = document.getElementById('save');
const addItemBtn = document.getElementById('add-item-btn');
const tableBody = document.getElementById('table-body');

function clickButton(button, name, callback) {
    try {
        button.addEventListener('click', () => {
            callback();
        })
    }
    catch(err) {
        throw new Error(button + 'element is null check if the element has an id of' + name)
    }
}

function openModal() {
    if(modal.classList.contains('hidden')){
        modal.classList.remove('hidden')
        modal.classList.add('flex')
    } else {
        modal.classList.remove('flex')
        modal.classList.add('hidden')
    }
}

function closeModal() {
    if(modal.classList.contains('flex')){
        modal.classList.remove('flex')
        modal.classList.add('hidden')
    }
}

function addTableRow() {
    try {
        const tr = document.createElement('tr')
        tr.innerHTML = `
            <input type="hidden" class="w-full h-full" name="invoice_item[]"
            value="0">
            <td class="p-3">
                <input type="text" class="w-full h-full" name="type[]">
            </td>
            <td class="p-3">
                <input type="text" class="w-full h-full" name="product_service[]">
            </td>
            <td class="p-3">
                <input type="number" class="w-full h-full quantity" value="0" name="quantity[]">
            </td>
            <td class="p-3">
                <input type="text" class="w-full h-full base-price" name="base_price[]">
            </td>
            <td class="p-3">
                <input type="text" class="w-full h-full" value="0" disabled>
            </td>
        `
        tableBody.appendChild(tr);
    }
    catch(err) {
        throw new Error(err.message)
    }
}

function basePriceChange() {
    try {

        const basePrice = document.querySelectorAll('.base-price');

        basePrice.forEach(input => {
           input.addEventListener("change", (e) => {
            if(!isNaN(e.target.value)) {
                console.log('test');
                const subtotalInput = e.target.parentElement.nextElementSibling.firstElementChild;
                const quantityInput = e.target.parentElement.previousElementSibling.firstElementChild;

                let subtotal = quantityInput.value * e.target.value;
                subtotalInput.value = subtotal;
                console.log(subtotal);

                console.log(subtotalInput);
            }
            })
        })
    } catch(err) {
        throw new Error(err.message)
    }
}

function quantityChange() {
    try {

        const quantity = document.querySelectorAll('.quantity');

        quantity.forEach(input => {
           input.addEventListener("change", (e) => {
            if(!isNaN(e.target.value)) {
                console.log('test');
                const subtotalInput = e.target.parentElement.nextElementSibling.nextElementSibling.firstElementChild;
                const basePrice = e.target.parentElement.nextElementSibling.firstElementChild;

                let subtotal = basePrice.value * e.target.value;
                subtotalInput.value = subtotal;
                console.log(subtotal);
            }
            })
        })
    } catch(err) {
        throw new Error(err.message)
    }
}

clickButton(clickButtonEl, 'edit-button', openModal)
clickButton(cancelButtonEl, 'cancel', closeModal)
clickButton(saveButtonEl, 'save', closeModal)
clickButton(addItemBtn, 'add-item-btn', addTableRow)


document.addEventListener('change', () => {
    basePriceChange()
    quantityChange()
})
