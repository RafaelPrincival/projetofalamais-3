$("#simulate").click(() => {
    let time = $("input[name=time]").val();
    let origin = $("#origin").val();
    let destination = $("#destination").val();
    let plan = $("#plan").val();

    if (!time.length) {
        alert("Please set the call time!");
        return;
    }

    $.ajax({
        url: `/api/calculate/${origin}/${destination}/${plan}/${time}`,
        type: "POST",
        contentType: "application/json",
        success: (data) => {
            if (data) {
                $("#origin-result").text(data.origin.code);
                $("#destination-result").text(data.destination.code);
                $("#time-result").text(data.time + " min(s)");
                $("#plan-result").text(data.plan.name);
                $("#plan-cost-result").text(data.planRateCost == null ? "-" : "R$ " + data.planRateCost);
                $("#without-plan-cost-result").text(data.rateCost == null ? "-" : "R$ " + data.rateCost);
            }
        },
        error: () => {
            alert("Error, please try again!");
        }
    });

    $("#results-modal").modal("show");
});
