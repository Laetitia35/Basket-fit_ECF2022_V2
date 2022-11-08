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

// Ajout d'une modale pour supprimer une franchise

      const myModal = document.getElementById('myModal')
      const myInput = document.getElementById('myInput')

      myModal.addEventListener('shown.bs.modal', () => {
      myInput.focus()
      })

      let Delete = document.querySelectorAll(".delete_franchise")
      for (let button of Delete ) {
        button.addEventListener("click", function() {
          document.querySelector(".validerDelete").href=`/admin/supprimer_une_franchise/${this.dataset.id}`
          document.querySelector(".modal-body").innerText = `Etes vous sûrs de vouloir supprimer la franchise "${this.dataset.name}"?`
        })
        
      }




    

