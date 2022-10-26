let collection, boutonAjout, span;
        window.onload = ()=> {
            collection = document.querySelector("#Permissions_globale");
            span = collection.querySelector("span");
            boutonAjout = document.createElement("button");
            boutonAjout.className = "ajout-Permissions_globale btn btn-warning";
            boutonAjout.innerText = "Ajouter une permission";

            let nouveauBouton = span.append(boutonAjout);

            collection.dataset.index = collection.querySelectorAll("input").length; 

            boutonAjout.addEventListener("click", function() {
                addButton(collection, nouveauBouton);
            });
        }
        function addButton(collection, nouveauBouton) {

            let prototype = collection.dataset.prototype;

            let index = collection.dataset.index;

            prototype = prototype.replace(/__name__/g, index);

            let content = document.createElement("html");
            content.innerHTML = prototype;
            let newForm = content.querySelector("div");

            let boutonSuppr = document.createElement("button");
            boutonSuppr.type = "button";
            boutonSuppr.className = "btn red";
            boutonSuppr.id= "delete-FranchisePermission-" + index;
            boutonSuppr.innerText = "Supprimer cette permission";

            newForm.append(boutonSuppr);
            collection.dataset.index++;

            let boutonAjout = collection.querySelector(".ajout-FranchisePermission");

            span.insertBefore(newForm, boutonAjout);

            boutonSuppr.addEventListener("click", function() {
                this.previousElementSibling.parentElement.remove();
            })
        }