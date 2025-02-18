let boutonAjouterLieu = document.getElementById('boutonAjouterLieu');
boutonAjouterLieu.addEventListener('click', function () {
    Swal.fire({
        width: '70%',
        background: '#C8E3DF',
        html: `
        <div class="w-full h-2/3">
            <form action="" class="flex w-full flex-col overflow-auto ">
                <h3 class="w-full px-2 text-c1 font-barlow uppercase font-semibold underline text-2xl">Ajouter</h3>  
                <div class="grid grid-cols-2 gap-4 mt-2">
                    <div class="font-semibold font-barlow "> 
                        <label for="champ1" class="block text-c1 text-left mb-1 font-semibold uppercase">Nom du lieu</label>
                        <input type="text" placeholder="Nom du lieu" class="font-barlow p-2 mb-2 border rounded-lg w-full">

                         <label for="champ1" class="block text-c1 text-left font-semibold uppercase">Nom du lieu</label>
                        <input type="text" placeholder="Numéro de téléphone" class="font-barlow p-2 mb-2 border rounded-lg w-full">

                         <label for="champ1" class="block text-c1 text-left font-semibold uppercase">Nom du lieu</label>
                        <input type="text" placeholder="Photo du lieu" class="font-barlow p-2 mb-2 border rounded-lg w-full">

                         <label for="champ1" class="block text-c1 text-left font-semibold uppercase">Nom du lieu</label>
                        <textarea  placeholder="Description" class="font-barlow p-2 mb-2 border rounded-lg w-full h-36 resize-none"></textarea>

                         <label for="champ1" class="block text-c1 text-left font-semibold uppercase">Nom du lieu</label>
                        <input type="text" placeholder="Site web" class="font-barlow p-2 mb-2 border rounded-lg w-full">
                    </div>
                    <div>
                        <input type="text" placeholder="Numéro civique" class="font-barlow p-2 mb-2 border rounded-lg w-full">
                        <input type="text" placeholder="Rue" class="font-barlow p-2 mb-2 border rounded-lg w-full">
                        <input type="text" placeholder="Code postal" class="font-barlow p-2 mb-2 border rounded-lg w-full">
                        <select id="selectPays" class="font-barlow p-2 mb-2 border rounded-lg w-full">
                            <option value="" disabled selected>Pays</option>
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                            <option value="option3">Option 3</option>
                        </select>
                        <select id="selectPays" class="font-barlow p-2 mb-2 border rounded-lg w-full">
                            <option value="" disabled selected>Ville</option>
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                            <option value="option3">Option 3</option>
                        </select>
                         <select id="selectProvince" class="font-barlow p-2 mb-2 border rounded-lg w-full">
                            <option value="" disabled selected>Province</option>
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                            <option value="option3">Option 3</option>
                        </select>
                         <select id="selectRegionAdministrative" class="font-barlow p-2 mb-2 border rounded-lg w-full">
                            <option value="" disabled selected>Région</option>
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                            <option value="option3">Option 3</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-row justify-evenly">
                    <button class="text-c1 py-2 px-6 font-barlow font-semibold text-xl rounded-full w-75 mt-2 hover:bg-c3 transition uppercase">
                        Annuler
                    </button>
                    <button type="submit" class="bg-c1 text-c3 py-2 px-6 font-barlow font-semibold text-xl rounded-full w-75 mt-2 uppercase">
                    Ajouter
                     </button>
                </div>
            </form>
        </div>
        `,
        showCloseButton: true,
        closeButtonHtml:
            '<span style="color: #154C51; font-size: 3rem;">&times;</span>',
        showCancelButton: false,
        showConfirmButton: false,
        focusConfirm: false
    });
});
