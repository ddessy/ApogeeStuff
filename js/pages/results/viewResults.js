$(document).ready(async function () {
    await getGames();

    async function getGames() {
        try {
            const response = await axios.get('api/games');
            // const response = await axios.get('games', {
            //     params: {
            //         ID: 12345
            //     }
            // });
            console.log(response);
        } catch (error) {
            console.error(error);
        }
    }
});
