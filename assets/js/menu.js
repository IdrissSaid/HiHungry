let data = [
['Gratin de chouchou-jambon ou poulet','6.50€'],
['Boucané poulet ti-jacques','P: 7.00€','G: 8.00€'],
['Quiche au saumon + salade verte','6.00€'],
['Poisson à la sauce grand mère','P: 7.00€','G: 8.00€'],
['Civet Porc carottes et champignons','P: 6.50€','G: 7.50€'],
['Sauté mines crevettes','P: 7.00€','G: 8.00€'],
['Sauté de boeuf gingembre','P: 7.00€','G: 8.00€'],
['Escalope de poulet sauce d\'huitre','P: 6.50€','G: 7.50€'],
['Porc Caramel','P: 6.50€','G: 7.50€'],
['Pâtes Bolognaise','P: 7.00€','G: 8.00€'],
];

export function setList(name) {
    let carte = document.getElementsByClassName('carte')[0];
    let title = document.createElement('h1');
    title.setAttribute('id', 'title');
    title.setAttribute('class', 'title_menu');
    title.textContent = name;
    carte.append(title);

    for (let i = data.length - 1; i >= 0; i--) {
        let ul = document.createElement('ul');
        ul.innerHTML = createLi(i);
        carte.append(ul);
    }
}

function createLi(index) {
    let str = '<li id=\'plat\'>' + data[index][0] + '</li>';
    for (let i = 1; data[index][i]; i++) {
        str += '<li id=\'price\'>' + data[index][i] + '</li>';
    }
    return str;
}
