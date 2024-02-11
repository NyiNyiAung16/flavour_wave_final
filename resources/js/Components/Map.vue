<template>
    <div class="map-wrap">
        <div class="map" ref="mapContainer"></div>
    </div>
</template>

<script setup>
import { Map, MapStyle, Marker, config, geolocation } from "@maptiler/sdk";
import { shallowRef, onMounted, onUnmounted, markRaw } from "vue";
import "@maptiler/sdk/dist/maptiler-sdk.css";

const emits = defineEmits(['location','companyLocation']);
const mapContainer = shallowRef(null);
const map = shallowRef(null);

onMounted(async () => {
    config.apiKey = "2Y8xWKR6TiKSh5wYRTkh";
    const res = await geolocation.info();
    emits("companyLocation", { lng: res.longitude, lat: res.latitude });

    const initialState = { lng: res.longitude, lat: res.latitude, zoom: 8 };

    map.value = markRaw(
        new Map({
            container: mapContainer.value,
            style: MapStyle.STREETS,
            center: [initialState.lng, initialState.lat],
            zoom: initialState.zoom,
        })
    );
    map.value.on("click", handleMapClick);

    async function handleMapClick(event) {
        const { lng, lat } = event.lngLat;
        const roundedLng = lng.toFixed(2);
        const roundedLat = lat.toFixed(2);
        new Marker({ color: "#FF0000" })
            .setLngLat([Number(roundedLng), Number(roundedLat)])
            .addTo(map.value);

        emits("location", { lng: Number(roundedLng), lat: Number(roundedLat) });
    }
}),
    onUnmounted(() => {
        map.value?.remove();
    });
</script>

<style scoped>
.map-wrap {
    position: relative;
    width: 90%;
    height: 80%;
    margin: 20px auto;
    height: calc(
        100vh - 77px
    ); /* calculate height of the screen minus the heading */
}

.map {
    margin-top: 10px;
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 5px;
}
</style>
