function toRadians(degrees) {
    return (degrees * Math.PI) / 180;
};

export function calculateDistance(lat1,lng1,lat2,lng2) {
    const R = 6371; // Earth's radius in kilometers

    const lat1Rad = toRadians(lat1);
    const lon1Rad = toRadians(lng1);
    const lat2Rad = toRadians(lat2);
    const lon2Rad = toRadians(lng2);

    const dLat = lat2Rad - lat1Rad;
    const dLon = lon2Rad - lon1Rad;

    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(lat1Rad) * Math.cos(lat2Rad) * Math.sin(dLon / 2) * Math.sin(dLon / 2);

    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

    const distance = R * c;
    return distance;
};




