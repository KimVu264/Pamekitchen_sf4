
//---------------------------------------------------------------------------------
// Ajout des inputs INGREDIENTS

document.addEventListener('DOMContentLoaded', function() {
    let addButton = document.getElementById('ingredient-add-item');
    console.log('123');

    addButton.addEventListener('click', function (e) {
        e.preventDefault();

        // Récupérer les attributs de données
        let index = addButton.dataset.index;
        let prototype = addButton.dataset.prototype;    
        
        
        // Créer un nouveau formulaire et MAJ index
        addButton.dataset.index = index +1;
        let protoForm = document.createElement('div');
        protoForm.innerHTML = prototype.replace(index, /__name__/g);
        protoForm = protoForm.firstChild;
      
        console.log(protoForm);
        document.getElementById('ingredient_list').appendChild(protoForm);

        //----------------------------------------------------------------------
        // Créér un custom formulaire 

        // // Main column: quantité
        // let primaryColumn = document.createElement('div');
        // primaryColumn.classList.add('column');
        // primaryColumn.appendChild(protoForm.querySelector('div.field:nth-child(2)').cloneNode(true));
        

        // // Secondary column: ingrédients
        // let secondaryColumn = document.createElement('div');
        // secondaryColumn.classList.add('column', 'is-two-fifths');
        // secondaryColumn.appendChild(protoForm.querySelector('div.field:nth-child(1)').cloneNode(true));
       

        // Champs du conteneur
        // let mediaContent = document.createElement('div');
        // mediaContent.classList.add('media-content');

        // // Delete button
        // mediaContent.innerHTML = `
        // <button type="button" class="button is-small is-danger is-light is-pulled-right form-collection-remove" data-form-item=".ingredient">
        //     <span class="icon"><i class="fal fa-times"></i></span>
        // </button>
        // <div class="columns"></div>`;

        // mediaContent.querySelector('button').addEventListener('click', function (e) {
        //     e.preventDefault();
        //     let item = mediaContent.querySelector('button').closest(mediaContent.querySelector('button').dataset.formIngredient);

        //     if (item !== null) {
        //         item.remove();
        //     }
        // });

        // mediaContent.querySelector('.columns').appendChild(primaryColumn);
        // mediaContent.querySelector('.columns').appendChild(secondaryColumn);

        // // Conteneur principal
        // let newForm = document.createElement('div');
        // newForm.classList.add('media', 'ingredient');
        // newForm.appendChild(mediaContent);

        //----------------------------------------------------------------------

        // Ajoute le formulaire à la liste
        // addButton.closest('.field').appendChild(newForm);
       
    });
});

//---------------------------------------------------------------------------------
// Ajout des inputs USTENSILES

document.addEventListener('DOMContentLoaded', function() {
    let addButton = document.getElementById('ustensile-add-item');
    console.log('123');

    addButton.addEventListener('click', function (e) {
        e.preventDefault();

        // Récupérer les attributs de données
        let prototypes = addButton.dataset.prototype;
        let index = addButton.dataset.index;
        console.log('123');
        

        // Créer un nouveau formulaire et MAJ index
        let protoForms = document.createElement('div');
        protoForms.innerHTML = prototypes.replace(/__name__/g, index);
        protoForms = protoForms.firstChild;
        addButton.dataset.index = index + 1;

       
        //----------------------------------------------------------------------
        // Créér un custom formulaire 

        // // Main column: quantité
        // let primaryColumn = document.createElement('div');
        // primaryColumn.classList.add('column');
        // primaryColumn.appendChild(protoForm.querySelector('div.field:nth-child(2)').cloneNode(true));
        

        // // Secondary column: ingrédients
        // let secondaryColumn = document.createElement('div');
        // secondaryColumn.classList.add('column', 'is-two-fifths');
        // secondaryColumn.appendChild(protoForm.querySelector('div.field:nth-child(1)').cloneNode(true));
       

        // Champs du conteneur
        // let mediaContent = document.createElement('div');
        // mediaContent.classList.add('media-content');

        // // Delete button
        // mediaContent.innerHTML = `
        // <button type="button" class="button is-small is-danger is-light is-pulled-right form-collection-remove" data-form-item=".ingredient">
        //     <span class="icon"><i class="fal fa-times"></i></span>
        // </button>
        // <div class="columns"></div>`;

        // mediaContent.querySelector('button').addEventListener('click', function (e) {
        //     e.preventDefault();
        //     let item = mediaContent.querySelector('button').closest(mediaContent.querySelector('button').dataset.formIngredient);

        //     if (item !== null) {
        //         item.remove();
        //     }
        // });

        // mediaContent.querySelector('.columns').appendChild(primaryColumn);
        // mediaContent.querySelector('.columns').appendChild(secondaryColumn);

        // // Conteneur principal
        // let newForm = document.createElement('div');
        // newForm.classList.add('media', 'ingredient');
        // newForm.appendChild(mediaContent);

        //----------------------------------------------------------------------

        // Ajoute le formulaire à la liste
        // addButton.closest('.field').appendChild(newForm);
        document.getElementById('ustensile_list').appendChild(protoForms);
    });
});