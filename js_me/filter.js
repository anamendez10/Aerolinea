document.addEventListener("keyup", e=>{
    if (e.target.matches("#buscador")){
  
        if (e.key === "Escape")e.target.value = ""
  
        document.querySelectorAll(".pricing-card").forEach(destino =>{
  
            destino.textContent.toLowerCase().includes(e.target.value.toLowerCase())
            ?destino.classList.remove("filtro")
            :destino.classList.add("filtro")
        })
    } 
})