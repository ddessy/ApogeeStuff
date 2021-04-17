$(document).ready(async function () {
    $('#mazeGameMultiselect').multiselect(
        {
            buttonWidth: '100%',
            buttonText: function(options) {
                if (options.length == 0) {
                    return 'Choose a property';
                }
                else if (options.length > 6) {
                    return options.length + selected;
                }
                else {
                    let selected = '';
                    options.each(function() {
                        selected += $(this).text() + ', ';
                    });
                    return selected.substr(0, selected.length -2);
                }
            },
            onChange: function(option, checked) {
                // Get selected options.
                var selectedOptions = $('#mazeGameMultiselect option:selected');

                if (selectedOptions.length >= 4) {
                    // Disable all other checkboxes.
                    var nonSelectedOptions = $('#mazeGameMultiselect option').filter(function() {
                        return !$(this).is(':selected');
                    });

                    var dropdown = $('#mazeGameMultiselect').siblings('.multiselect-container');
                    nonSelectedOptions.each(function() {
                        var input = $('input[value="' + $(this).val() + '"]');
                        input.prop('disabled', true);
                        input.parent('button').addClass('disabled');
                    });
                }
                else {
                    // Enable all checkboxes.
                    var dropdown = $('#mazeGameMultiselect').siblings('.multiselect-container');
                    $('#mazeGameMultiselect option').each(function() {
                        var input = $('input[value="' + $(this).val() + '"]');
                        input.prop('disabled', false);
                        input.parent('li').addClass('disabled');
                    });
                }
            }
        }
    );
});

function filterMazeGameSecondSelectOptions() {
    const selectedValue = document.getElementById("mazeGameFirstColumn").value;
    const secondColumn = document.getElementById("mazeGameSecondColumn");

    for (let i = 0; i < secondColumn.length; i++) {
        if (secondColumn.options[i].value === selectedValue) {
            secondColumn.options[i].style.display = 'none';
        } else {
            secondColumn.options[i].style.display = 'block';
        }
    }
}

function filterMazeGameFirstSelectOptions() {
    const selectedValue = document.getElementById("mazeGameSecondColumn").value;
    const firstColumn = document.getElementById("mazeGameFirstColumn");

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

async function onSelectMazeGame() {
    const selectedMazeGameId = document.getElementById("selectMazeGames").value;
    const selectMiniGames = document.getElementById("selectMiniGames");

    while (selectMiniGames.firstChild) {
        selectMiniGames.removeChild(selectMiniGames.lastChild);
    }

    if (selectedMazeGameId) {
        const miniGames = await getMiniGames(selectedMazeGameId);

        if (miniGames.length > 0) {
            let defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.innerHTML = 'Choose a Hall / Mini-game';
            selectMiniGames.appendChild(defaultOption);

            for (let i = 0; i < miniGames.length; i++) {
                let option = document.createElement('option');
                option.value = miniGames[i].puzzle_game_name;
                option.innerHTML = miniGames[i].puzzle_game_name;
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
        defaultOption.innerHTML = 'Please choose a maze-game first';
        selectMiniGames.appendChild(defaultOption);
    }
}

async function getMiniGames(gameId) {
    try {
        const response = await axios.get(`api/miniGames/${gameId}`);
        return response.data;
    } catch (error) {
        console.error(error);
    }
}

async function calculateMazeGame() {
    const selectedMazeGameId = document.getElementById("selectMazeGames").value;
    const mazeGameFirstColumn = document.getElementById("mazeGameFirstColumn").value;
    const mazeGameSecondColumn = document.getElementById("mazeGameSecondColumn").value;
    const selectedMazeGameMethod = document.getElementById("mazeGameMethod").value;

    if (selectedMazeGameId) {
        document.getElementById("mazeGameError").style.display = 'none';

        if (mazeGameFirstColumn && mazeGameSecondColumn) {
            document.getElementById("mazeGamePropertiesError").style.display = 'none';
            let response = await calculateMazeGameResult(selectedMazeGameId, mazeGameFirstColumn, mazeGameSecondColumn, selectedMazeGameMethod);
            document.getElementById("mazeGameFirstColumnM").innerHTML = response.averageFirstColumn;
            document.getElementById("mazeGameFirstColumnSD").innerHTML = response.standardDeviationFirstColumn;
            document.getElementById("mazeGameFirstColumnSE").innerHTML = response.standardErrorFirstColumn;
            document.getElementById("mazeGameSecondColumnM").innerHTML = response.averageSecondColumn;
            document.getElementById("mazeGameSecondColumnSD").innerHTML = response.standardDeviationSecondColumn;
            document.getElementById("mazeGameSecondColumnSE").innerHTML = response.standardErrorSecondColumn;
            document.getElementById("mazeGameMethodResult").innerHTML = response.mazeGameMethodResult;
        } else {
            document.getElementById("mazeGamePropertiesError").style.display = 'block';
        }
    } else {
        document.getElementById("mazeGameError").style.display = 'block';
    }
}

async function calculateMazeGameResult(selectedMazeGameId, mazeGameFirstColumn, mazeGameSecondColumn, selectedMazeGameMethod) {
    try {
        const response = await axios.post('api/statistics/calculateMazeGameResult', {
            params: {
                selectedMazeGameId: selectedMazeGameId,
                mazeGameFirstColumn: mazeGameFirstColumn,
                mazeGameSecondColumn: mazeGameSecondColumn,
                selectedMazeGameMethod: selectedMazeGameMethod,
            }
        });
        console.log(response);
        return response.data;
    } catch (error) {
        console.error(error);
        document.getElementById("mazeGameFirstColumnM").innerHTML = '-';
        document.getElementById("mazeGameFirstColumnSD").innerHTML = '-';
        document.getElementById("mazeGameFirstColumnSE").innerHTML = '-';
        document.getElementById("mazeGameSecondColumnM").innerHTML = '-';
        document.getElementById("mazeGameSecondColumnSD").innerHTML = '-';
        document.getElementById("mazeGameSecondColumnSE").innerHTML = '-';
        document.getElementById("mazeGameMethodResult").innerHTML = '-';
    }
}

async function calculateMiniGame() {
    const selectedMiniGameName = document.getElementById("selectMiniGames").value;
    const miniGameFirstColumn = document.getElementById("miniGameFirstColumn").value;
    const miniGameSecondColumn = document.getElementById("miniGameSecondColumn").value;
    const selectedMiniGameMethod = document.getElementById("miniGameMethod").value;

    if (selectedMiniGameName) {
        document.getElementById("miniGameError").style.display = 'none';

        if (miniGameFirstColumn && miniGameSecondColumn) {
            document.getElementById("miniGamePropertiesError").style.display = 'none';
            let response = await calculateMiniGameResult(selectedMiniGameName, miniGameFirstColumn, miniGameSecondColumn, selectedMiniGameMethod);
            document.getElementById("miniGameFirstColumnM").innerHTML = response.averageFirstColumn;
            document.getElementById("miniGameFirstColumnSD").innerHTML = response.standardDeviationFirstColumn;
            document.getElementById("miniGameFirstColumnSE").innerHTML = response.standardErrorFirstColumn;
            document.getElementById("miniGameSecondColumnM").innerHTML = response.averageSecondColumn;
            document.getElementById("miniGameSecondColumnSD").innerHTML = response.standardDeviationSecondColumn;
            document.getElementById("miniGameSecondColumnSE").innerHTML = response.standardErrorSecondColumn;
            document.getElementById("miniGameMethodResult").innerHTML = response.miniGameMethodResult;
        } else {
            document.getElementById("miniGamePropertiesError").style.display = 'block';
        }
    } else {
        document.getElementById("miniGameError").style.display = 'block';
    }
}

async function calculateMiniGameResult(selectedMiniGameName, miniGameFirstColumn, miniGameSecondColumn, selectedMiniGameMethod) {
    try {
        const response = await axios.post('api/statistics/calculateMiniGameResult', {
            params: {
                selectedMiniGameName: selectedMiniGameName,
                miniGameFirstColumn: miniGameFirstColumn,
                miniGameSecondColumn: miniGameSecondColumn,
                selectedMiniGameMethod: selectedMiniGameMethod,
            }
        });
        console.log(response);
        return response.data;
    } catch (error) {
        console.error(error);
        document.getElementById("miniGameFirstColumnM").innerHTML = '-';
        document.getElementById("miniGameFirstColumnSD").innerHTML = '-';
        document.getElementById("miniGameFirstColumnSE").innerHTML = '-';
        document.getElementById("miniGameSecondColumnM").innerHTML = '-';
        document.getElementById("miniGameSecondColumnSD").innerHTML = '-';
        document.getElementById("miniGameSecondColumnSE").innerHTML = '-';
        document.getElementById("miniGameMethodResult").innerHTML = '-';
    }
}
