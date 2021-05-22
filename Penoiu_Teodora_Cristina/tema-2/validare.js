function validationTitlu(r) {
    let denumire_produs = /[^a-zA-Z]/;
    r.value = r.value.replace(denumire_produs, "");
}

//functie care valideaza um (doar cifre)
function validationUM(r) {
    let um = /[^1-9]/;
    r.value = r.value.replace(um, "");
}

//functie care valideaza cantitatea (doar cifre)
function validationCantitate(r) {
    let cantitate = /[^1-9]/;
    r.value = r.value.replace(cantitate, "");
}

//functie care valideaza pretul unitar (doar cifre)
function validationPretUnitar(r) {
    let pret_unitar = /[^1-9]/;
    r.value = r.value.replace(pret_unitar, "");
}