const LOW_GLUCOSE_COLOR = "#FFD65A";
const NORMAL_GLUCOSE_COLOR = "#16C47F";
const HIGH_GLUCOSE_COLOR = "#f93827";
const GLUCOSE_BACKGROUND_COLOR = "rgba(194, 252, 217, 0.25)";
const GLUCOSE_LINE_COLOR = "#c2fcd9";

const WEIGHT_BACKGROUND_COLOR = "rgba(255, 214, 186, 0.3)";
const WEIGHT_LINE_COLOR = "#F0A04B";
const WEIGHT_POINT_COLOR = "#7F55B1";

const CHART_TOOLTIP_BACKGROUND_COLOR = "rgba(0, 0, 0, 0.8)";

function drawChart(records, ctx) {
    const measurementTimes = records.map(
        (record) => record.formatted_measure_at
    );
    const glucoses = records.map((record) => record.glucose);
    const weights = records.map((record) => record.weight);
    const statuesColor = records.map((record) => {
        if (record.status == "low") return LOW_GLUCOSE_COLOR;
        if (record.status == "normal") return NORMAL_GLUCOSE_COLOR;
        if (record.status == "high") return HIGH_GLUCOSE_COLOR;
        return LOW_GLUCOSE_COLOR;
    });

    new Chart(ctx, {
        type: "line",
        data: {
            labels: measurementTimes,
            datasets: [
                {
                    label: "Chỉ số đường huyết (mg/dL)",
                    data: glucoses,
                    backgroundColor: GLUCOSE_BACKGROUND_COLOR,
                    pointBackgroundColor: statuesColor,
                    borderColor: GLUCOSE_LINE_COLOR,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    fill: true,
                    tension: 0.3,
                },
                {
                    label: "Cân nặng (kg)",
                    data: weights,
                    backgroundColor: WEIGHT_BACKGROUND_COLOR,
                    borderColor: WEIGHT_LINE_COLOR,
                    pointBackgroundColor: WEIGHT_POINT_COLOR,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    fill: true,
                    tension: 0.3,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
                x: {
                    title: {
                        display: true,
                        text: "Thời gian",
                    },
                },
            },
            interaction: {
                intersect: true,
                mode: "point",
            },
            plugins: {
                lengend: {
                    display: false,
                },
                tooltip: {
                    backgroundColor: CHART_TOOLTIP_BACKGROUND_COLOR,
                    callbacks: {
                        afterBody: (tooltipItem, data) => {
                            console.log(tooltipItem);
                            const context = tooltipItem[0];
                            const datasetIndex = context.datasetIndex;
                            const index = context.dataIndex;

                            if (datasetIndex == 0) {
                                const record = records[index];
                                return [
                                    `Trạng thái: ${record.status_label}`,
                                    `Thời điểm đo: ${record.measurement_point_label}`,
                                ];
                            }
                        },
                    },
                },
            },
        },
    });
}
