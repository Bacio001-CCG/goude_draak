
document.addEventListener('DOMContentLoaded', function() {
    const addButton = document.getElementById('addButton');
    const removeButton = document.getElementById('removeButton');
    const container = document.querySelector('.grid');

    let counter = 0;
    const maxFields = 7;

    addButton.addEventListener('click', function() {
        if (counter < maxFields) {
            counter++;

            const div = document.createElement('div');
            div.classList.add('flex', 'gap-5');

            div.innerHTML = `
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name_${counter}">
                        Naam
                    </label>
                    <input name="names[]" required value="" class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name_${counter}" type="text" placeholder="Naam">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="date_of_birth_${counter}">
                        Geboortedatum
                    </label>
                    <input name="dates_of_birth[]" required value="" class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date_of_birth_${counter}" type="date">
                </div>
            `;

            container.appendChild(div);

            if (counter === maxFields) {
                addButton.disabled = true;
                addButton.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }
    });

    removeButton.addEventListener('click', function() {
        if (counter > 0) {
            counter--;
            container.removeChild(container.lastElementChild);

            if (counter < maxFields) {
                addButton.disabled = false;
                addButton.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }
    });
});
