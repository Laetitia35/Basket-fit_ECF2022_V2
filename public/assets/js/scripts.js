// admin activer btn franchise  

window.onload = () => {
    let active_franchise = document.querySelectorAll("[id=franchise_active]")
    for (let button of active_franchise) {
        button.addEventListener("click", function() {
            let xmlhttp = new XMLHttpRequest;
            //xmlhttp.onReadyStateChange = () => {
                //verifier la reponse :200
            //}
            xmlhttp.open("get",`/admin/activer_une_franchise/${this.dataset.id}`)
            xmlhttp.send()
        })
    }
}


// admin activer btn Structure  

window.onload = () => {
    let active = document.querySelectorAll("[id=structure_active]")
    for (let button of active) {
        button.addEventListener("click", function() {
            let xmlhttp = new XMLHttpRequest;
            //xmlhttp.onReadyStateChange = () => {
                //verifier la reponse :200
            //}
            xmlhttp.open("get",`/admin/activer_une_structure/${this.dataset.id}`)
            xmlhttp.send()
        })
    }
}


// admin activer btn Permission  

window.onload = () => {
    let active = document.querySelectorAll("[id=permission_active]")
    for (let button of active) {
        button.addEventListener("click", function() {
            let xmlhttp = new XMLHttpRequest;
            //xmlhttp.onReadyStateChange = () => {
                //verifier la reponse :200
            //}
            xmlhttp.open("get",`/admin/activer_une_permission/${this.dataset.id}`)
            xmlhttp.send()
        })
    }
}

var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})


// Ajout d'une modale pour supprimer une franchise


let supprimer = document.querySelectorAll(".modalSupprimerFranchise")
for (let button of supprimer ) {
  button.addEventListener("click", function() {
    document.querySelector(".modal-footer a").href=`/admin/supprimer_une_franchise/${this.dataset.id}`
    document.querySelector(".modal-body").innerText = `Etes vous sûr(e) de vouloir supprimer la franchise ? "${this.dataset.name}"`
  })
  
}


// Ajout d'une modale pour supprimer une structure


  let Delete = document.querySelectorAll(".modalSupprimerStructure")
  for (let button of Delete ) {
    button.addEventListener("click", function() {
      document.querySelector(".modal-footer a").href=`/admin/supprimer_une_structure/${this.dataset.id}`
      document.querySelector(".modal-body").innerText = `Etes vous sûr(e) de vouloir supprimer la structure ?"${this.dataset.name}"`
    })
    
  }



    

