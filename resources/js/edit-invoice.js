console.log('test');


const tbody = document.getElementById('invoice-item-body');
const addItemBtn = document.getElementById('add-item-btn');


addItemBtn.addEventListener('click', () => {
    const tr = document.createElement('tr')
    tr.setAttribute('class', 'bg-white');
    tr.innerHTML = `
        <th scope="row" class="font-medium whitespace-nowrap p-2">
        <input type="text" class="w-full h-full px-2 py-4" name="type">
        </th>
        <td class="px-6 py-4">
            <input type="text" class="w-full h-full px-2 py-4" name="product-service">
        </td>
        <td class="px-6 py-4">
            <input type="number" class="w-full h-full px-2 py-4" value="0" name="quantity">
        </td>
        <td class="px-6 py-4">
            <input type="text" class="w-full h-full px-2 py-4" name="base-price">
        </td>
        <td class="px-6 py-4">
            <input type="text" class="w-full h-full px-2 py-4" value="0" disabled>
        </td>
    `
    tbody.appendChild(tr);
})

console.log(tbody);
