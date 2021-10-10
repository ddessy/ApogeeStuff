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
        }
    );

    $('#miniGameMultiselect').multiselect(
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
        }
    )
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
        const response = await axios.get(getPath() + '/miniGames/' + gameId);
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
            let response = await getMazeGameResult(selectedMazeGameId, selectedMazeGameMethod, selectedProperties);

            let propertyResultsDiv = $('#containerMazePropertiesResults');
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
                                                    <div id="maze${propertyResults}" style="width:400px;height:400px;"></div>
                                                </div>
                                           </div>`);

                let mazePropertyResults = document.getElementById('maze' + propertyResults);

                let trace1 = {
                    y: response.propertiesResults[propertyResults].data,
                    type: 'box'
                };

                let data = [trace1];

                let layout = {
                    paper_bgcolor: 'rgb(243, 243, 243)',
                    plot_bgcolor: 'rgb(243, 243, 243)',
                };

                Plotly.newPlot(mazePropertyResults, data, layout);
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
                                                <span style="font-size: 16px">${combination}</span>
                                                <h6><span style="color: dodgerblue">${response.mazeGameMethodResults[combination]}</span></h6>
                                           </div>`);
            }
        } else {
            document.getElementById("mazeGamePropertiesError").style.display = 'block';
        }
    } else {
        document.getElementById("mazeGameError").style.display = 'block';
    }
}

async function getMazeGameResult(selectedMazeGameId, selectedMazeGameMethod, selectedProperties) {
    try {
        const response = await axios.post(getPath() + '/calculateMazeGameResult', {
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
        let propertyResultsDiv = $('#containerMazePropertiesResults');
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
    const selectedMiniGameMethodElement = document.getElementById("miniGameMethod");
    const selectedMiniGameMethod = document.getElementById("miniGameMethod").value;
    const selectedProperties = $('#miniGameMultiselect').val();

    if (selectedMiniGameName) {
        document.getElementById("miniGameError").style.display = 'none';

        if (selectedProperties.length > 0) {
            document.getElementById("miniGamePropertiesError").style.display = 'none';
            if (!selectedMiniGameMethod) {
                document.getElementById("miniGameMethodError").style.display = 'block';
                return;
            }
            document.getElementById("miniGameMethodError").style.display = 'none';
            document.getElementById("miniGameMethodResultsError").style.display = 'none';
            let response = await getMiniGameResult(selectedMiniGameName, selectedMiniGameMethod, selectedProperties);

            let propertyResultsDiv = $('#containerMiniPropertiesResults');
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
                                                    <div id="mini${propertyResults}" style="width:400px;height:400px;"></div>
                                                </div>
                                           </div>`);

                let miniPropertyResults = document.getElementById('mini' + propertyResults);

                let trace1 = {
                    y: response.propertiesResults[propertyResults].data,
                    type: 'box'
                };

                let data = [trace1];

                let layout = {
                    paper_bgcolor: 'rgb(243, 243, 243)',
                    plot_bgcolor: 'rgb(243, 243, 243)',
                };

                Plotly.newPlot(miniPropertyResults, data, layout);
            }

            let methodResultsDiv = $('#miniGameMethodResults');
            while (methodResultsDiv[0].firstChild) {
                methodResultsDiv[0].removeChild(methodResultsDiv[0].firstChild);
            }
            methodResultsDiv.append(`<h5 class="custom-margin-bottom">${selectedMiniGameMethodElement.options[selectedMiniGameMethodElement.selectedIndex].text} results:</h5>`);
            if (response.miniGameMethodResults.length === 0) {
                document.getElementById("miniGameMethodResultsError").style.display = 'block';
                return;
            }
            for (let combination in response.miniGameMethodResults) {
                methodResultsDiv.append(`<div class="custom-margin-bottom  custom-border" style="padding: 10px; justify-content: space-between">
                                                <span style="font-size: 16px">${combination}</span>
                                                <h6><span style="color: dodgerblue">${response.miniGameMethodResults[combination]}</span></h6>
                                           </div>`);
            }
        } else {
            document.getElementById("miniGamePropertiesError").style.display = 'block';
        }
    } else {
        document.getElementById("miniGameError").style.display = 'block';
    }
}

async function getMiniGameResult(selectedMiniGameName, selectedMiniGameMethod, selectedProperties) {
    try {
        const response = await axios.post(getPath() + '/calculateMiniGameResult', {
            params: {
                selectedMiniGameName: selectedMiniGameName,
                selectedMiniGameMethod: selectedMiniGameMethod,
                selectedProperties: selectedProperties,
            }
        });
        console.log(response, 'response mini game result');
        return response.data;
    } catch (error) {
        console.error(error);
        let propertyResultsDiv = $('#containerMiniPropertiesResults');
        while (propertyResultsDiv[0].firstChild) {
            propertyResultsDiv[0].removeChild(propertyResultsDiv[0].firstChild);
        }
        let methodResultsDiv = $('#miniGameMethodResults');
        while (methodResultsDiv[0].firstChild) {
            methodResultsDiv[0].removeChild(methodResultsDiv[0].firstChild);
        }
    }
}
