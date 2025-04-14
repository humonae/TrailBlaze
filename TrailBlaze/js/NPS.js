const apiKey = 'KEY_HERE'; // Use php wrapper to hide key
const apiUrl = 'https://developer.nps.gov/api/v1/';

async function fetchParks() { //EVER, BISC, DRTO, CANA, DESO, FOCA, TIMU, BICY, GUIS, FOMA....
    //note: FOCA does not return anything,  it's not a national park and is a park under TIMU
    const parkCodes = ["EVER", "BISC", "DRTO", "CANA", "DESO", "TIMU", "BICY", "GUIS", "FOMA"];
    try {
        const results = await Promise.all(parkCodes.map(fetchParkInfo));
        const Parks = {};
        parkCodes.forEach((code, index) => {
            Parks[code] = results[index];
        });
        return Parks;
    }  catch (error) {
        console.error('Error fetching parks:', error);
    }
}
//Obtains information for each park in JSON format
async function fetchParkInfo(parkCode) {
    const res = await fetch(`${apiUrl}parks?parkCode=${parkCode}&api_key=${apiKey}`);
    const data = await res.json();
    return data.data[0];
}
