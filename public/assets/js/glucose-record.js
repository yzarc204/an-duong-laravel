const filterDateFromInput = document.querySelector("#filterDateFrom");
const filterDateToInput = document.querySelector("#filterDateTo");
const filterStatusInput = document.querySelector("#filterStatus");
const filterButton = document.querySelector("#filterButton");
const clearFilterButton = document.querySelector("#clearFilterButton");

filterButton.addEventListener("click", filter);
clearFilterButton.addEventListener("click", clearFilter);
document.addEventListener("DOMContentLoaded", handleDocumentReady);

const params = new URLSearchParams(window.location.search);

function handleDocumentReady() {
    const ctx = document.getElementById("chart").getContext("2d");
    drawChart(records, ctx);

    if (params.get("dateFrom")) {
        filterDateFromInput.value = params.get("dateFrom");
    }
    if (params.get("dateTo")) {
        filterDateToInput.value = params.get("dateTo");
    }
    if (params.get("status")) {
        filterStatusInput.value = params.get("status");
    }
}

function filter() {
    if (filterDateFromInput.value) {
        params.set("dateFrom", filterDateToInput.value);
    } else {
        params.delete("dateFrom");
    }

    if (filterDateToInput.value) {
        params.set("dateTo", filterDateToInput.value);
    } else {
        params.delete("dateTo");
    }

    if (filterStatusInput.value && filterStatusInput.value !== "") {
        params.set("status", filterStatusInput.value);
    }
    if (filterStatusInput.value == "") {
        params.delete("status");
    }

    params.delete("page");

    const newUrl = `${window.location.pathname}${
        params.toString() ? "?" + params.toString() : ""
    }`;
    window.location.href = newUrl;
}

function clearFilter() {
    filterDateToInput.value = "";
    filterDateFromInput.value = "";
    filterStatusInput.value = "";
    filter();
}
