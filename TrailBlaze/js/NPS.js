const apiProxyUrl = 'https://cise.ufl.edu/~mplummer1/TrailBlaze/js/nps_proxy.php'; // Use HTTPS

async function fetchParks() {
    const parkCodes = ["EVER", "BISC", "DRTO", "CANA", "DESO", "TIMU", "BICY", "GUIS", "FOMA", "CASA"];
    try {
        const results = await Promise.all(parkCodes.map(fetchParkInfo));
        const Parks = {};
        parkCodes.forEach((code, index) => {
            Parks[code] = results[index];   
        });
        return Parks;
    } catch (error) {
        console.error('Error fetching park list:', error);
        return null;
    } 
}

async function fetchParkInfo(parkCode) {
    try {
        const res = await fetch(`${apiProxyUrl}?parkCode=${parkCode}`);
        if (!res.ok) {
            throw new Error(`Failed to fetch park info for ${parkCode}`);
        }
        const data = await res.json();
        console.log(`Data for parkCode ${parkCode}:`, data); // Debugging output
        return data.data[0];
    } catch (error) {
        console.error('Error fetching park info:', error);
        return null;
    }
}
