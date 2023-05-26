async function changeJoke(event){
    event.preventDefault()


    await fetch("https://localhost:8000/chuckone")
        .then(response=>response.json())
        .then((data)=>{
            const joke = this.previousElementSibling
            joke.innerHTML = data.value
        })
}

function saveJoke(event){
    event.preventDefault()

    let pLink = document.querySelector('#jokeValue-'+this.id)
    console.log(pLink)
    let pValue = pLink.innerHTML

    let url = "https://localhost:8000/blague/save"

    let body = {
        value:pValue
    }
    console.log(body)

    let fetchParams = {
        method:'POST',
        headers:{
            "Content-Type":"application/json"
        },
        body:JSON.stringify(body)
    }

    console.log(fetchParams)

    fetch(url, fetchParams)
        .then(response=>response.json())
        .then(data=>{
            pLink.innerHTML = data.value
        })

}





function getButtonsJoke(){
    const buttonChangeJoke = document.querySelectorAll('#changeJoke')
    buttonChangeJoke.forEach((button)=>{
        button.addEventListener('click', changeJoke)
    })
}

function getButtonsSaveJoke(){
    const buttonSaveJoke = document.querySelectorAll('.save')
    buttonSaveJoke.forEach((button)=>{
        button.addEventListener('click', saveJoke)
    })
}



document.addEventListener('DOMContentLoaded', ()=>{
    getButtonsJoke()
    getButtonsSaveJoke()
})

