const apiProxyUrl = 'https://cise.ufl.edu/~clark.samuel/TrailBlaze/js/nps_proxy.php'; // Use HTTPS

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
