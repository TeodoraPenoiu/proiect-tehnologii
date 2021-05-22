//functie care valideaza titlul anuntului
function validationText(r) {
    let titlu = /[^a-zA-Z ]/;
    r.value = r.value.replace(titlu, "");
}

//functie care valideaza continutul anuntului
function validationContinut(r) {
    let continut = /[^a-zA-Z0-9!&'?_`{|}():=. ]/;
    r.value = r.value.replace(continut, "");
}

//functie care valideaza nota per subiect
function validationNota(r) {
    let nota = /[^0-9]/;
    r.value = r.value.replace(nota, "");
    if(r.value > 100){
        r.value = r.value.replace(r.value, "");
    } else if(r.value <= 0){
        r.value = r.value.replace(r.value, "");
    }
}