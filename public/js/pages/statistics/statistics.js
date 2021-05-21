$(document).ready(async function () {
    $('#mazeGameMultiselect').multiselect(
        {
            buttonWidth: '100%',
            buttonText: function (options) {
                if (options.length === 0) {
                    return 'Select a properties';
                } else if (options.length > 6) {
                    return options.length + selected;
                } else {
                    let selected = '';
                    options.each(function () {
                        selected += $(this).text() + ', ';
                    });
                    return selected.substr(0, selected.length - 2);
                }
            },
            onChange: function (option, checked) {
                // Get selected options.
                let selectedOptions = $('#mazeGameMultiselect option:selected');

                if (selectedOptions.length >= 4) {
                    // Disable all other checkboxes.
                    let nonSelectedOptions = $('#mazeGameMultiselect option').filter(function () {
                        return !$(this).is(':selected');
                    });

                    let dropdown = $('#mazeGameMultiselect').siblings('.multiselect-container');
                    nonSelectedOptions.each(function () {
                        var input = $('input[value="' + $(this).val() + '"]');
                        input.prop('disabled', true);
                        input.parent('button').addClass('disabled');
                    });
                } else {
                    // Enable all checkboxes.
                    let dropdown = $('#mazeGameMultiselect').siblings('.multiselect-container');
                    $('#mazeGameMultiselect option').each(function () {
                        var input = $('input[value="' + $(this).val() + '"]');
                        input.prop('disabled', false);
                        input.parent('li').addClass('disabled');
                    });
                }
            }
        }
    );
});

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
    const selectedMazeGameMethodElement = document.getElementById("mazeGameMethod");
    const selectedMazeGameMethod = document.getElementById("mazeGameMethod").value;
    const selectedProperties = $('#mazeGameMultiselect').val();

    if (selectedMazeGameId) {
        document.getElementById("mazeGameError").style.display = 'none';

        if (selectedProperties.length > 0) {
            document.getElementById("mazeGamePropertiesError").style.display = 'none';
            if (!selectedMazeGameMethod) {
                document.getElementById("mazeGameMethodError").style.display = 'block';
                return;
            }
            document.getElementById("mazeGameMethodError").style.display = 'none';
            document.getElementById("mazeGameMethodResultsError").style.display = 'none';
            let response = await calculateMazeGameResult(selectedMazeGameId, selectedMazeGameMethod, selectedProperties);

            let propertyResultsDiv = $('#containerPropertiesResults');
            while (propertyResultsDiv[0].firstChild) {
                propertyResultsDiv[0].removeChild(propertyResultsDiv[0].firstChild);
            }
            for (let propertyResults in response.propertiesResults) {
                propertyResultsDiv.append(`<div class="custom-margin-bottom  custom-border" style="padding: 10px; justify-content: space-between">
                                                <div>
                                                    <div>
                                                        <h5>${propertyResults}</h5>
                                                        <h6>n: <span style="color: dodgerblue">${response.propertiesResults[propertyResults].data.length}</span></h6>
                                                        <h6>M: <span style="color: dodgerblue">${response.propertiesResults[propertyResults].average}</span></h6>
                                                        <h6>SD: <span style="color: dodgerblue">${response.propertiesResults[propertyResults].standardDeviation}</span></h6>
                                                        <h6>SE: <span style="color: dodgerblue">${response.propertiesResults[propertyResults].standardError}</span></h6>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div id="${propertyResults}" style="width:400px;height:400px;"></div>
                                                </div>
                                           </div>`);

                let TESTER = document.getElementById(propertyResults);

                let trace1 = {
                    y: response.propertiesResults[propertyResults].data,
                    type: 'box'
                };

                let data = [trace1];

                let layout = {
                    paper_bgcolor: 'rgb(243, 243, 243)',
                    plot_bgcolor: 'rgb(243, 243, 243)',
                };

                Plotly.newPlot(TESTER, data, layout);
            }

            let methodResultsDiv = $('#mazeGameMethodResults');
            while (methodResultsDiv[0].firstChild) {
                methodResultsDiv[0].removeChild(methodResultsDiv[0].firstChild);
            }
            methodResultsDiv.append(`<h5 class="custom-margin-bottom">${selectedMazeGameMethodElement.options[selectedMazeGameMethodElement.selectedIndex].text} results:</h5>`);
            if (response.mazeGameMethodResults.length === 0) {
                document.getElementById("mazeGameMethodResultsError").style.display = 'block';
                return;
            }
            for (let combination in response.mazeGameMethodResults) {
                methodResultsDiv.append(`<div class="custom-margin-bottom  custom-border" style="padding: 10px; justify-content: space-between">
                                                <span class="inline-block" style="font-size: 16px">${combination}:</span>
                                                <h6 class="inline-block"><span style="color: dodgerblue">${response.mazeGameMethodResults[combination]}</span></h6>
                                           </div>`);
            }
        } else {
            document.getElementById("mazeGamePropertiesError").style.display = 'block';
        }
    } else {
        document.getElementById("mazeGameError").style.display = 'block';
    }
}

async function calculateMazeGameResult(selectedMazeGameId, selectedMazeGameMethod, selectedProperties) {
    try {
        const response = await axios.post('api/statistics/calculateMazeGameResult', {
            params: {
                selectedMazeGameId: selectedMazeGameId,
                selectedMazeGameMethod: selectedMazeGameMethod,
                selectedProperties: selectedProperties,
            }
        });
        console.log(response, 'response maze game result');
        return response.data;
    } catch (error) {
        console.error(error);
        let propertyResultsDiv = $('#containerPropertiesResults');
        while (propertyResultsDiv[0].firstChild) {
            propertyResultsDiv[0].removeChild(propertyResultsDiv[0].firstChild);
        }
        let methodResultsDiv = $('#mazeGameMethodResults');
        while (methodResultsDiv[0].firstChild) {
            methodResultsDiv[0].removeChild(methodResultsDiv[0].firstChild);
        }
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
