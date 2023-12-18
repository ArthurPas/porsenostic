
let selectElements = document.querySelectorAll('select');
document.addEventListener("DOMContentLoaded", async function () {
    await fillWithData("https://devapascal.fr/coursesHippiques/Drivers.php", document.getElementById('driver'))
    await fillWithData("https://devapascal.fr/coursesHippiques/Hippodromes.php", document.getElementById('hippodrome'))
    await fillWithData("https://devapascal.fr/coursesHippiques/Trainers.php", document.getElementById('trainer'))
    await fillWithData("https://devapascal.fr/coursesHippiques/Length.php", document.getElementById('length'))
    await fillWithData("https://devapascal.fr/coursesHippiques/Def.php", document.getElementById('def'))
    await fillWithData("https://devapascal.fr/coursesHippiques/Place.php", document.getElementById('place'))
    await fillWithData("https://devapascal.fr/coursesHippiques/Spe.php", document.getElementById('spe'))
    await fillWithData("https://devapascal.fr/coursesHippiques/Penalty.php", document.getElementById('penalty'))
    await fillWithData("https://devapascal.fr/coursesHippiques/Age.php", document.getElementById('age'))
});
document.getElementById("clear").addEventListener("click", function () {
    selectElements.forEach(function (selectElement) {
        selectElement.options[0].selected = true;
    });
    let tableBody = document.getElementById("tableBody");
    while (tableBody.firstChild) {
        tableBody.removeChild(tableBody.firstChild);
    }
})
document.getElementById("seeResult").addEventListener("click", function () {

    // Create an array to store selected options
    let notEmptySelect = [];

    // Iterate through each select element
    selectElements.forEach(function (selectElement) {
        // Check if the first option is not selected
        if (selectElement.options[0].selected === false) {
            // Add the select element to the array
            notEmptySelect.push(selectElement);
        }
    });
    let url = "https://devapascal.fr/coursesHippiques/Stat.php?"
    let i = 0
    let tableBody = document.getElementById("tableBody");
    while (tableBody.firstChild) {
        tableBody.removeChild(tableBody.firstChild);
    }
    for (singleSelect of notEmptySelect) {
        url += singleSelect.id + "=" + singleSelect.value;
        if (i !== notEmptySelect.length - 1) {
            url += "&";
        }
        i++;
    }
    fetch(url)
        .then(response => response.json())
        .then(data => {
            data.forEach(item => {
                let tr = document.createElement("tr");
                let td = document.createElement("td");
                td.textContent = item.trainer;
                tr.appendChild(td);
                td = document.createElement("td");
                td.textContent = item.number_of_occurrences;
                tr.appendChild(td);
                td = document.createElement("td");
                let avgPlace = Number(item.average_place);

                td.textContent = avgPlace.toFixed(2);
                tr.appendChild(td);
                td = document.createElement("td");
                let avgPlaceAllTime = Number(item.overall_average_place);
                td.textContent = avgPlaceAllTime.toFixed(2);
                tr.appendChild(td);
                tableBody.appendChild(tr);
            });
        })
})
async function fillWithData(url, list) {
    fetch(url)
        .then(response => response.json())
        .then(data => {
            createListOptions(data, list);
        })
}

function createListOptions(data, list) {
    data.forEach(item => {
        let option = document.createElement('option');
        option.value = item;
        option.textContent = item;
        list.appendChild(option);
    });
}