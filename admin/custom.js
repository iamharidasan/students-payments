jQuery(document).ready(function ($) {
  // Create a new College Fee
  const collegeFeeModal = new bootstrap.Modal("#collegeFeeModal")
  $("#collegeFeeSem,#collegeFeeFee,#collegeFeeScheme").on(
    "change",
    function () {
      if (
        $("#collegeFeeSem").find(":selected").val() != "" &&
        $("#collegeFeeScheme").find(":selected").val() != "" &&
        $("#collegeFeeFee").val() != "" &&
        $("#collegeFeeMonth").val() != "" &&
        $("#collegeFeeYear").val() != ""
      ) {
        $("#save-college-fee").prop("disabled", false)
      }
    }
  )
  $(".addCollegeFee").on("click", function (e) {
    e.preventDefault()
    $("#collegeFeeType").val("Add")
    collegeFeeModal.show()
    $("#college-fee-alert")
      .html("")
      .removeClass("alert-danger")
      .removeClass("alert-success")
      .hide()
  })
  $(document).on("click", ".editCollegeFee", function (e) {
    e.preventDefault()
    $("#collegeFeeType").val("Update")
    $("#collegeFeeId").val($(this).data("id"))
    $("#collegeFeeSName").val($(this).data("sname"))
    $("#collegeFeeBName").val($(this).data("bname"))
    $("#collegeFeeBCode").val($(this).data("bcode"))
    $("#collegeFeeRegNo").val($(this).data("regno"))
    $("#collegeFeeCommty").val($(this).data("commty"))
    $("#collegeFeeGender").val($(this).data("gender"))
    $("#collegeFeeSem").val($(this).data("sem"))
    $("#collegeFeeMonth").val($(this).data("month"))
    $("#collegeFeeYear").val($(this).data("year"))
    $("#collegeFeeScheme").val($(this).data("scheme"))
    $("#collegeFeeFee").val($(this).data("fee"))
    $("#save-college-fee").prop("disabled", false)
    collegeFeeModal.show()
    $("#college-fee-alert")
      .html("")
      .removeClass("alert-danger")
      .removeClass("alert-success")
      .hide()
  })
  $("#save-college-fee").on("click", function (e) {
    e.preventDefault()
    $.ajax({
      url: "process-college-fee.php",
      type: "POST",
      data: $("#college-fee-form").serialize(),
      success: function (data) {
        data = JSON.parse(data)
        if (data.type == "success") {
          $("#college-fee-alert")
            .html(data.message)
            .removeClass("alert-danger")
            .addClass("alert-success")
            .show()
          $("#college-fees").html("")
          data.rows.forEach((row) => {
            $("#college-fees").append(
              "<tr><td>" +
                row.sem +
                "</td><td>" +
                row.month +
                "</td><td>" +
                row.year +
                "</td><td>" +
                row.scheme +
                "</td><td>" +
                row.fee +
                "</td><td><button class='editCollegeFee btn btn-info' data-id='" +
                row.id +
                "' data-regno='" +
                row.regno +
                "' data-sname='" +
                row.sname +
                "' data-bcode='" +
                row.bcode +
                "' data-bname='" +
                row.bname +
                "' data-sem='" +
                row.sem +
                "' data-month='" +
                row.month +
                "' data-year='" +
                row.year +
                "' data-fee='" +
                row.fee +
                "' data-scheme='" +
                row.scheme +
                "' data-gender='" +
                row.gender +
                "' data-commty='" +
                row.commty +
                "'>Edit</button> | <button class='deleteCollegeFee btn btn-danger' data-id='" +
                row.id +
                "' data-regno='" +
                row.regno +
                "'>Delete</button></td></tr>"
            )
          })
        } else {
          $("#college-fee-alert")
            .html(data.message)
            .removeClass("alert-success")
            .addClass("alert-danger")
            .show()
        }
      },
    })
  })
  $(document).on("click", ".deleteCollegeFee", function (e) {
    e.preventDefault()
    $.ajax({
      url: "process-college-fee.php",
      method: "POST",
      data: {
        delete: $(this).data("id"),
        regno: $(this).data("regno"),
      },
      success: function (data) {
        data = JSON.parse(data)
        if (data.type == "success") {
          $("#college-fees").html("")
          data.rows.forEach((row) => {
            $("#college-fees").append(
              "<tr><td>" +
                row.sem +
                "</td><td>" +
                row.month +
                "</td><td>" +
                row.year +
                "</td><td>" +
                row.scheme +
                "</td><td>" +
                row.fee +
                "</td><td><button class='editCollegeFee btn btn-info' data-id='" +
                row.id +
                "' data-regno='" +
                row.regno +
                "' data-sname='" +
                row.sname +
                "' data-bcode='" +
                row.bcode +
                "' data-bname='" +
                row.bname +
                "' data-sem='" +
                row.sem +
                "' data-month='" +
                row.month +
                "' data-year='" +
                row.year +
                "' data-fee='" +
                row.fee +
                "' data-scheme='" +
                row.scheme +
                "' data-gender='" +
                row.gender +
                "' data-commty='" +
                row.commty +
                "'>Edit</button> | <button class='deleteCollegeFee btn btn-danger' data-id='" +
                row.id +
                "' data-regno='" +
                row.regno +
                "'>Delete</button></td></tr>"
            )
          })
        }
      },
    })
  })

  //Exam Fee
  const examFeeModal = new bootstrap.Modal("#examFeeModal")
  $("#examFeeSem,#examFeeFee,#examFeeScheme,#examFeeMonth,#examFeeYear").on(
    "change",
    function () {
      if (
        $("#examFeeSem").find(":selected").val() != "" &&
        $("#examFeeScheme").find(":selected").val() != "" &&
        $("#examFeeMonth").val() != "" &&
        $("#examFeeYear").val() != "" &&
        $("#examFeeFee").val() != ""
      ) {
        $("#save-exam-fee").prop("disabled", false)
      }
    }
  )
  $(".addExamFee").on("click", function (e) {
    e.preventDefault()
    $("#examFeeType").val("Add")
    examFeeModal.show()
    $("#exam-fee-alert")
      .html("")
      .removeClass("alert-danger")
      .removeClass("alert-success")
      .hide()
  })
  $(document).on("click", ".editExamFee", function (e) {
    e.preventDefault()
    $("#examFeeType").val("Update")
    $("#examFeeId").val($(this).data("id"))
    $("#examFeeSName").val($(this).data("sname"))
    $("#examFeeBName").val($(this).data("bname"))
    $("#examFeeBCode").val($(this).data("bcode"))
    $("#examFeeRegNo").val($(this).data("regno"))
    $("#examFeeCommty").val($(this).data("commty"))
    $("#examFeeGender").val($(this).data("gender"))
    $("#examFeeSem").val($(this).data("sem"))
    $("#examFeeMonth").val($(this).data("month"))
    $("#examFeeYear").val($(this).data("year"))
    $("#examFeeScheme").val($(this).data("scheme"))
    $("#examFeeFee").val($(this).data("fee"))
    $("#save-exam-fee").prop("disabled", false)
    examFeeModal.show()
    $("#exam-fee-alert")
      .html("")
      .removeClass("alert-danger")
      .removeClass("alert-success")
      .hide()
  })
  $("#save-exam-fee").on("click", function (e) {
    e.preventDefault()
    $.ajax({
      url: "process-exam-fee.php",
      type: "POST",
      data: $("#exam-fee-form").serialize(),
      success: function (data) {
        data = JSON.parse(data)
        if (data.type == "success") {
          $("#exam-fee-alert")
            .html(data.message)
            .removeClass("alert-danger")
            .addClass("alert-success")
            .show()
          $("#exam-fees").html("")
          data.rows.forEach((row) => {
            $("#exam-fees").append(
              "<tr><td>" +
                row.sem +
                "</td><td>" +
                row.month +
                "</td><td>" +
                row.year +
                "</td><td>" +
                row.scheme +
                "</td><td>" +
                row.fee +
                "</td><td><button class='editExamFee btn btn-info' data-id='" +
                row.id +
                "' data-regno='" +
                row.regno +
                "' data-sname='" +
                row.sname +
                "' data-bcode='" +
                row.bcode +
                "' data-bname='" +
                row.bname +
                "' data-sem='" +
                row.sem +
                "' data-month='" +
                row.month +
                "' data-year='" +
                row.year +
                "' data-fee='" +
                row.fee +
                "' data-scheme='" +
                row.scheme +
                "' data-gender='" +
                row.gender +
                "' data-commty='" +
                row.commty +
                "'>Edit</button> | <button class='deleteExamFee btn btn-danger' data-id='" +
                row.id +
                "' data-regno='" +
                row.regno +
                "'>Delete</button></td></tr>"
            )
          })
        } else {
          $("#exam-fee-alert")
            .html(data.message)
            .removeClass("alert-success")
            .addClass("alert-danger")
            .show()
        }
      },
    })
  })
  $(document).on("click", ".deleteExamFee", function (e) {
    e.preventDefault()
    $.ajax({
      url: "process-exam-fee.php",
      method: "POST",
      data: {
        delete: $(this).data("id"),
        regno: $(this).data("regno"),
      },
      success: function (data) {
        data = JSON.parse(data)
        if (data.type == "success") {
          $("#exam-fees").html("")
          data.rows.forEach((row) => {
            $("#exam-fees").append(
              "<tr><td>" +
                row.sem +
                "</td><td>" +
                row.month +
                "</td><td>" +
                row.year +
                "</td><td>" +
                row.scheme +
                "</td><td>" +
                row.fee +
                "</td><td><button class='editExamFee btn btn-info' data-id='" +
                row.id +
                "' data-regno='" +
                row.regno +
                "' data-sname='" +
                row.sname +
                "' data-bcode='" +
                row.bcode +
                "' data-bname='" +
                row.bname +
                "' data-sem='" +
                row.sem +
                "' data-month='" +
                row.month +
                "' data-year='" +
                row.year +
                "' data-fee='" +
                row.fee +
                "' data-scheme='" +
                row.scheme +
                "' data-gender='" +
                row.gender +
                "' data-commty='" +
                row.commty +
                "'>Edit</button> | <button class='deleteExamFee btn btn-danger' data-id='" +
                row.id +
                "' data-regno='" +
                row.regno +
                "'>Delete</button></td></tr>"
            )
          })
        }
      },
    })
  })

  //Bus Fee
  const busFeeModal = new bootstrap.Modal("#busFeeModal")
  $(
    "#busFeeSem,#busFeeFee,#busFeeStopPlace,#busFeeBusNo,#busFeeMonth,#busFeeYear"
  ).on("change", function () {
    if (
      $("#busFeeSem").find(":selected").val() != "" &&
      $("#busFeeStopPlace").val() != "" &&
      $("#busFeeBusNo").val() != "" &&
      $("#busFeeMonth").val() != "" &&
      $("#busFeeYear").val() != "" &&
      $("#busFeeFee").val() != ""
    ) {
      $("#save-bus-fee").prop("disabled", false)
    }
  })
  $(".addBusFee").on("click", function (e) {
    e.preventDefault()
    $("#busFeeType").val("Add")
    busFeeModal.show()
    $("#bus-fee-alert")
      .html("")
      .removeClass("alert-danger")
      .removeClass("alert-success")
      .hide()
  })
  $(document).on("click", ".editBusFee", function (e) {
    e.preventDefault()
    $("#busFeeType").val("Update")
    $("#busFeeId").val($(this).data("id"))
    $("#busFeeSName").val($(this).data("sname"))
    $("#busFeeBName").val($(this).data("bname"))
    $("#busFeeBCode").val($(this).data("bcode"))
    $("#busFeeRegNo").val($(this).data("regno"))
    $("#busFeeCommty").val($(this).data("commty"))
    $("#busFeeGender").val($(this).data("gender"))
    $("#busFeeSem").val($(this).data("sem"))
    $("#busFeeMonth").val($(this).data("month"))
    $("#busFeeYear").val($(this).data("year"))
    $("#busFeeBusNo").val($(this).data("busno"))
    $("#busFeeStop").val($(this).data("stop"))
    $("#busFeeFee").val($(this).data("fee"))
    $("#save-bus-fee").prop("disabled", false)
    busFeeModal.show()
    $("#bus-fee-alert")
      .html("")
      .removeClass("alert-danger")
      .removeClass("alert-success")
      .hide()
  })
  $("#save-bus-fee").on("click", function (e) {
    e.preventDefault()
    $.ajax({
      url: "process-bus-fee.php",
      type: "POST",
      data: $("#bus-fee-form").serialize(),
      success: function (data) {
        data = JSON.parse(data)
        if (data.type == "success") {
          $("#bus-fee-alert")
            .html(data.message)
            .removeClass("alert-danger")
            .addClass("alert-success")
            .show()
          $("#bus-fees").html("")
          data.rows.forEach((row) => {
            $("#bus-fees").append(
              "<tr><td>" +
                row.sem +
                "</td><td>" +
                row.month +
                "</td><td>" +
                row.year +
                "</td><td>" +
                row.bus_no +
                "</td><td>" +
                row.stop_place +
                "</td><td>" +
                row.fee +
                "</td><td><button class='editBusFee btn btn-info' data-id='" +
                row.id +
                "' data-regno='" +
                row.regno +
                "' data-sname='" +
                row.sname +
                "' data-bcode='" +
                row.bcode +
                "' data-bname='" +
                row.bname +
                "' data-sem='" +
                row.sem +
                "' data-month='" +
                row.month +
                "' data-year='" +
                row.year +
                "' data-fee='" +
                row.fee +
                "' data-stop='" +
                row.stop_place +
                "' data-busno='" +
                row.bus_no +
                "' data-gender='" +
                row.gender +
                "' data-commty='" +
                row.commty +
                "'>Edit</button> | <button class='deleteBusFee btn btn-danger' data-id='" +
                row.id +
                "' data-regno='" +
                row.regno +
                "'>Delete</button></td></tr>"
            )
          })
        } else {
          $("#bus-fee-alert")
            .html(data.message)
            .removeClass("alert-success")
            .addClass("alert-danger")
            .show()
        }
      },
    })
  })
  $(document).on("click", ".deleteBusFee", function (e) {
    e.preventDefault()
    $.ajax({
      url: "process-bus-fee.php",
      method: "POST",
      data: {
        delete: $(this).data("id"),
        regno: $(this).data("regno"),
      },
      success: function (data) {
        data = JSON.parse(data)
        if (data.type == "success") {
          $("#bus-fees").html("")
          data.rows.forEach((row) => {
            $("#bus-fees").append(
              "<tr><td>" +
                row.sem +
                "</td><td>" +
                row.month +
                "</td><td>" +
                row.year +
                "</td><td>" +
                row.bus_no +
                "</td><td>" +
                row.stop_place +
                "</td><td>" +
                row.fee +
                "</td><td><button class='editBusFee btn btn-info' data-id='" +
                row.id +
                "' data-regno='" +
                row.regno +
                "' data-sname='" +
                row.sname +
                "' data-bcode='" +
                row.bcode +
                "' data-bname='" +
                row.bname +
                "' data-sem='" +
                row.sem +
                "' data-month='" +
                row.month +
                "' data-year='" +
                row.year +
                "' data-fee='" +
                row.fee +
                "' data-busno='" +
                row.bus_no +
                "' data-stop='" +
                row.stop_place +
                "' data-gender='" +
                row.gender +
                "' data-commty='" +
                row.commty +
                "'>Edit</button> | <button class='deleteBusFee btn btn-danger' data-id='" +
                row.id +
                "' data-regno='" +
                row.regno +
                "'>Delete</button></td></tr>"
            )
          })
        }
      },
    })
  })

  //Hostel Fee
  const hostelFeeModal = new bootstrap.Modal("#hostelFeeModal")
  $(
    "#hostelFeeSem,#hostelFeeFee,#hostelFeeStaffName,#hostelFeeRoomNo,#hostelFeeMonth,#hostelFeeYear"
  ).on("change", function () {
    if (
      $("#hostelFeeSem").find(":selected").val() != "" &&
      $("#hostelFeeStaffName").val() != "" &&
      $("#hostelFeeRoomNo").val() != "" &&
      $("#hostelFeeMonth").val() != "" &&
      $("#hostelFeeYear").val() != "" &&
      $("#hostelFeeFee").val() != ""
    ) {
      $("#save-hostel-fee").prop("disabled", false)
    }
  })
  $(".addHostelFee").on("click", function (e) {
    e.preventDefault()
    $("#hostelFeeType").val("Add")
    hostelFeeModal.show()
    $("#hostel-fee-alert")
      .html("")
      .removeClass("alert-danger")
      .removeClass("alert-success")
      .hide()
  })
  $(document).on("click", ".editHostelFee", function (e) {
    e.preventDefault()
    $("#hostelFeeType").val("Update")
    $("#hostelFeeId").val($(this).data("id"))
    $("#hostelFeeSName").val($(this).data("sname"))
    $("#hostelFeeBName").val($(this).data("bname"))
    $("#hostelFeeBCode").val($(this).data("bcode"))
    $("#hostelFeeRegNo").val($(this).data("regno"))
    $("#hostelFeeCommty").val($(this).data("commty"))
    $("#hostelFeeGender").val($(this).data("gender"))
    $("#hostelFeeSem").val($(this).data("sem"))
    $("#hostelFeeMonth").val($(this).data("month"))
    $("#hostelFeeYear").val($(this).data("year"))
    $("#hostelFeeRoomNo").val($(this).data("roomno"))
    $("#hostelFeeStaffName").val($(this).data("staff"))
    $("#hostelFeePhone").val($(this).data("phone"))
    $("#hostelFeeMailId").val($(this).data("mailid"))
    $("#hostelFeeAddress").val($(this).data("address"))
    $("#hostelFeeFee").val($(this).data("fee"))
    $("#hostelFeeDOB").val($(this).data("dob"))
    $("#save-hostel-fee").prop("disabled", false)
    hostelFeeModal.show()
    $("#hostel-fee-alert")
      .html("")
      .removeClass("alert-danger")
      .removeClass("alert-success")
      .hide()
  })
  $("#save-hostel-fee").on("click", function (e) {
    e.preventDefault()
    $.ajax({
      url: "process-hostel-fee.php",
      type: "POST",
      data: $("#hostel-fee-form").serialize(),
      success: function (data) {
        data = JSON.parse(data)
        if (data.type == "success") {
          $("#hostel-fee-alert")
            .html(data.message)
            .removeClass("alert-danger")
            .addClass("alert-success")
            .show()
          $("#hostel-fees").html("")
          data.rows.forEach((row) => {
            $("#hostel-fees").append(
              "<tr><td>" +
                row.sem +
                "</td><td>" +
                row.month +
                "</td><td>" +
                row.year +
                "</td><td>" +
                row.room_no +
                "</td><td>" +
                row.staff_name +
                "</td><td>" +
                row.fee +
                "</td><td><button class='editHostelFee btn btn-info' data-id='" +
                row.id +
                "' data-regno='" +
                row.regno +
                "' data-sname='" +
                row.sname +
                "' data-bcode='" +
                row.bcode +
                "' data-bname='" +
                row.bname +
                "' data-sem='" +
                row.sem +
                "' data-month='" +
                row.month +
                "' data-year='" +
                row.year +
                "' data-fee='" +
                row.fee +
                "' data-staff='" +
                row.staff_name +
                "' data-roomno='" +
                row.room_no +
                "' data-gender='" +
                row.gender +
                "' data-commty='" +
                row.commty +
                "' data-address='" +
                row.address +
                "' data-phone='" +
                row.sphone_no +
                "' data-mailid='" +
                row.mail_id +
                "' data-dob='" +
                row.dob +
                "'>Edit</button> | <button class='deleteHostelFee btn btn-danger' data-id='" +
                row.id +
                "' data-regno='" +
                row.regno +
                "'>Delete</button></td></tr>"
            )
          })
        } else {
          $("#hostel-fee-alert")
            .html(data.message)
            .removeClass("alert-success")
            .addClass("alert-danger")
            .show()
        }
      },
    })
  })
  $(document).on("click", ".deleteHostelFee", function (e) {
    e.preventDefault()
    $.ajax({
      url: "process-hostel-fee.php",
      method: "POST",
      data: {
        delete: $(this).data("id"),
        regno: $(this).data("regno"),
      },
      success: function (data) {
        data = JSON.parse(data)
        if (data.type == "success") {
          $("#hostel-fees").html("")
          data.rows.forEach((row) => {
            $("#hostel-fees").append(
              "<tr><td>" +
                row.sem +
                "</td><td>" +
                row.month +
                "</td><td>" +
                row.year +
                "</td><td>" +
                row.room_no +
                "</td><td>" +
                row.staff_name +
                "</td><td>" +
                row.fee +
                "</td><td><button class='editHostelFee btn btn-info' data-id='" +
                row.id +
                "' data-regno='" +
                row.regno +
                "' data-sname='" +
                row.sname +
                "' data-bcode='" +
                row.bcode +
                "' data-bname='" +
                row.bname +
                "' data-sem='" +
                row.sem +
                "' data-month='" +
                row.month +
                "' data-year='" +
                row.year +
                "' data-fee='" +
                row.fee +
                "' data-roomno='" +
                row.room_no +
                "' data-staff='" +
                row.staff_name +
                "' data-gender='" +
                row.gender +
                "' data-commty='" +
                row.commty +
                "' data-address='" +
                row.address +
                "' data-phone='" +
                row.sphone_no +
                "' data-mailid='" +
                row.mail_id +
                "' data-dob='" +
                row.dob +
                "'>Edit</button> | <button class='deleteHostelFee btn btn-danger' data-id='" +
                row.id +
                "' data-regno='" +
                row.regno +
                "'>Delete</button></td></tr>"
            )
          })
        }
      },
    })
  })
})
