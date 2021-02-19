$(document).ready(async function () {
});

function filterGameSecondSelectOptions() {
    const selectedValue = document.getElementById("gameFirstColumn").value;
    const secondColumn = document.getElementById("gameSecondColumn");

    for (let i = 0; i < secondColumn.length; i++) {
        if (secondColumn.options[i].value === selectedValue) {
            secondColumn.options[i].style.display = 'none';
        } else {
            secondColumn.options[i].style.display = 'block';
        }
    }
}

function filterGameFirstSelectOptions() {
    const selectedValue = document.getElementById("gameSecondColumn").value;
    const firstColumn = document.getElementById("gameFirstColumn");

    for (let i = 0; i < firstColumn.length; i++) {
        if (firstColumn.options[i].value === selectedValue) {
            firstColumn.options[i].style.display = 'none';
        } else {
            firstColumn.options[i].style.display = 'block';
        }
    }
}

function filterMiniGameSecondSelectOptions() {
    const selectedValue = document.getElementById("miniGameFirstColumn").value;
    const secondColumn = document.getElementById("miniGameSecondColumn");

    for (let i = 0; i < secondColumn.length; i++) {
        if (secondColumn.options[i].value === selectedValue) {
            secondColumn.options[i].style.display = 'none';
        } else {
            secondColumn.options[i].style.display = 'block';
        }
    }
}

function filterMiniGameFirstSelectOptions() {
    const selectedValue = document.getElementById("miniGameSecondColumn").value;
    const firstColumn = document.getElementById("miniGameFirstColumn");

    for (let i = 0; i < firstColumn.length; i++) {
        if (firstColumn.options[i].value === selectedValue) {
            firstColumn.options[i].style.display = 'none';
        } else {
            firstColumn.options[i].style.display = 'block';
        }
    }
}

async function getMiniGames(gameId) {
    try {
        const response = await axios.get(`api/miniGames/${gameId}`);
        console.log(response);
        return response.data;
    } catch (error) {
        console.error(error);
    }
}

async function onSelectGame() {
    const selectedGameId = document.getElementById("selectGames").value;
    const selectMiniGames = document.getElementById("selectMiniGames");

    while (selectMiniGames.firstChild) {
        selectMiniGames.removeChild(selectMiniGames.lastChild);
    }

    if (selectedGameId) {
        const games = await getMiniGames(selectedGameId);

        if (games.length > 0) {
            let defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.innerHTML = 'Choose a Hall / Mini-game';
            selectMiniGames.appendChild(defaultOption);

            for (let i = 0; i < games.length; i++) {
                let option = document.createElement('option');
                option.value = games[i].puzzle_game_name;
                option.innerHTML = games[i].puzzle_game_name;
                selectMiniGames.appendChild(option);
            }
        } else {
            let defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.innerHTML = 'No data';
            selectMiniGames.appendChild(defaultOption);
        }
    } else {
        let defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.innerHTML = 'Please choose a game first';
        selectMiniGames.appendChild(defaultOption);
    }
}

async function calculateGameResult(selectedGameId, gameFirstColumn, gameSecondColumn, gameMethod) {
    try {
        const response = await axios.post('api/statistics/calculateGameResult', {
            params: {
                selectedGameId: selectedGameId,
                gameFirstColumn: gameFirstColumn,
                gameSecondColumn: gameSecondColumn,
                gameMethod: gameMethod
            }
        });
        console.log(response);
        return response.data;
    } catch (error) {
        console.error(error);
    }
}

async function calculateGame() {
    const selectedGameId = document.getElementById("selectGames").value;
    const gameFirstColumn = document.getElementById("gameFirstColumn").value;
    const gameSecondColumn = document.getElementById("gameSecondColumn").value;
    const gameMethod = document.getElementById("gameMethods").value;

    if (selectedGameId) {
        document.getElementById("gameError").style.display = 'none';

        if (gameFirstColumn && gameSecondColumn && gameMethod) {
            document.getElementById("gamePropertiesError").style.display = 'none';
            let response = await calculateGameResult(selectedGameId, gameFirstColumn, gameSecondColumn, gameMethod);
            const resultGame = document.getElementById("resultGame").value = 1;
        } else {
            document.getElementById("gamePropertiesError").style.display = 'block';
        }
    } else {
        document.getElementById("gameError").style.display = 'block';
    }
}

async function calculateMiniGameResult(selectedMiniGameId, miniGameFirstColumn, miniGameSecondColumn, miniGameMethod) {
    try {
        const response = await axios.post('api/statistics/calculateMiniGameResult', {
            params: {
                selectedMiniGameId: selectedMiniGameId,
                miniGameFirstColumn: miniGameFirstColumn,
                miniGameSecondColumn: miniGameSecondColumn,
                miniGameMethod: miniGameMethod
            }
        });
        console.log(response);
        return response.data;
    } catch (error) {
        console.error(error);
    }
}

async function calculateMiniGame() {
    const selectedMiniGameId = document.getElementById("selectMiniGames").value;
    const miniGameFirstColumn = document.getElementById("miniGameFirstColumn").value;
    const miniGameSecondColumn = document.getElementById("miniGameSecondColumn").value;
    const miniGameMethod = document.getElementById("miniGameMethods").value;

    console.log(miniGameMethod);

    if (selectedMiniGameId) {
        document.getElementById("miniGameError").style.display = 'none';

        if (miniGameFirstColumn && miniGameSecondColumn && miniGameMethod) {
            document.getElementById("miniGamePropertiesError").style.display = 'none';
            let response = await calculateMiniGameResult(selectedMiniGameId, miniGameFirstColumn, miniGameSecondColumn, miniGameMethod);
            const resultMiniGame = document.getElementById("resultMiniGame").value = 1;
        } else {
            document.getElementById("miniGamePropertiesError").style.display = 'block';
        }
    } else {
        document.getElementById("miniGameError").style.display = 'block';
    }
}
