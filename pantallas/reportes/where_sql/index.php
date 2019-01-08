<!--  It is a good idea to bundle all CSS in one file. The same with JS -->
 
<!--  JQUERY -->
<script type="text/javascript" src="/path/to/jquery.min.js"></script>
 
<!--  JQUERY-UI (optional) -->
<!--  in this example: datepicker, autocompete, slider, spinner are in use in filters -->
<link rel="stylesheet" type="text/css" href="/path/to/jquery-ui.min.css">
<script type="text/javascript" src="/path/to/jquery-ui.min.js"></script>
<!--  timepicker is used in filters -->
<link rel="stylesheet" type="text/css" href="/path/to/jquery-ui-timepicker-addon.min.css"/>
<script type="text/javascript" src="/path/to/jquery-ui-timepicker-addon.min.js"></script>
<!--  if touch event support is needed (mobile devices) -->
<script type="text/javascript" src="/path/to/jquery.ui.touch-punch.min.js"></script>
 
<!-- jui_filter_rules -->
<link rel="stylesheet" type="text/css" href="/path/to/jquery.jui_filter_rules.bs.min.css">
<script type="text/javascript" src="/path/to/jquery.jui_filter_rules.min.js"></script>
<script type="text/javascript" src="/path/to/jui_filter_rules/localization/en.min.js"></script>
<!--  required from filters plugin -->
<script type="text/javascript" src="/path/to/moment.min.js"></script>
<script type="text/javascript" >
$(function() {
 
    $("#demo_rules1").jui_filter_rules({
 
        bootstrap_version: "3",
 
        filters: [
            {
                filterName: "Lastname", "filterType": "text", field: "lastname", filterLabel: "Last name",
                excluded_operators: ["in", "not_in"],
                filter_interface: [
                    {
                        filter_element: "input",
                        filter_element_attributes: {"type": "text", "value": "Smith"}
                    }
                ]
            },
            {
                filterName: "AgeInYears", "filterType": "number", "numberType": "double", field: "age", filterLabel: "Age (years)",
                excluded_operators: ["in", "not_in"]
            },
            {
                filterName: "GroupMembers", "filterType": "number", "numberType": "integer", field: "group_members", filterLabel: "Group Members",
                excluded_operators: ["in", "not_in"],
                filter_interface: [
                    {
                        filter_element: "input",
                        filter_element_attributes: {
                            type: "text",
                            value: "1",
                            "style": "width: 75px; margin: 0 5px;"
                        },
                        filter_widget: "spinner",
                        filter_widget_properties: {
                            min: 1,
                            max: 10
                        }
                    }
 
                ]
            },
            {
                filterName: "PerCentCompleted", "filterType": "number", "numberType": "integer", field: "percent_completed", filterLabel: "PerCent Completed",
                excluded_operators: ["in", "not_in"],
                filter_interface: [
                    {
                        filter_element: "input",
                        filter_element_attributes: {
                            type: "text",
                            disabled: "disabled",
                            style: "width: 40px;  display: inline-block;"
                        }
                    },
                    {
                        filter_element: "div",
                        filter_element_attributes: {
                            style: "width: 120px; margin-left: 15px; display: inline-block;"
                        },
                        filter_widget: "slider",
                        filter_widget_properties: {
                            min: 0,
                            max: 100,
                            slide: function(event, ui) {
                                $(this).prev("input").val(ui.value);
                            }
                        },
                        returns_no_value: "yes"
                    }
                ]
            },
            {
                filterName: "DateInserted", "filterType": "date", field: "date_inserted", filterLabel: "Date inserted",
                excluded_operators: ["in", "not_in"],
                filter_interface: [
                    {
                        filter_element: "input",
                        filter_element_attributes: {
                            type: "text"
                        },
                        filter_widget: "datepicker",
                        filter_widget_properties: {
                            dateFormat: "dd/mm/yy",
                            changeMonth: true,
                            changeYear: true
                        }
                    }
                ],
                validate_dateformat: ["DD/MM/YYYY"],
                filter_value_conversion_server_side: {
                    function_name: "date_encode",
                    args: [
                        {"filter_value": "yes"},
                        {"value": "d/m/Y"}
                    ]
                }
            },
            {
                filterName: "DateUpdated", "filterType": "date", field: "date_updated", filterLabel: "Datetime updated",
                excluded_operators: ["in", "not_in"],
                filter_interface: [
                    {
                        filter_element: "input",
                        filter_element_attributes: {
                            type: "text",
                            title: "Set the date and time using format: dd/mm/yyyy hh:mm:ss"
                        },
                        filter_widget: "datetimepicker",
                        filter_widget_properties: {
                            dateFormat: "dd/mm/yy",
                            timeFormat: "HH:mm:ss",
                            changeMonth: true,
                            changeYear: true,
                            showSecond: true
                        }
                    }
                ],
                validate_dateformat: ["DD/MM/YYYY HH:mm:ss"],
                filter_value_conversion: {
                    function_name: "local_datetime_to_UTC_timestamp",
                    args: [
                        {"filter_value": "yes"},
                        {"value": "DD/MM/YYYY HH:mm:ss"}
                    ]
                }
            },
            {
                filterName: "Category", "filterType": "number", "numberType": "integer", field: "category", filterLabel: "Category (ajax data)",
                excluded_operators: ["equal", "not_equal", "less", "less_or_equal", "greater", "greater_or_equal"],
                filter_interface: [
                    {
                        filter_element: "input",
                        filter_element_attributes: {type: "checkbox"},
                        vertical_orientation: "yes"
                    }
                ],
                lookup_values_ajax_url: "ajax/ajax_categories.php"
            },
            {
                filterName: "Level", "filterType": "number", "numberType": "integer", field: "level", filterLabel: "Level",
                excluded_operators: ["in", "not_in", "less", "less_or_equal", "greater", "greater_or_equal"],
                filter_interface: [
                    {
                        filter_element: "input",
                        filter_element_attributes: {
                            type: "radio",
                            style: "width: auto; margin-top: 0; display: inline-block;"
                        }
                    }
                ],
                lookup_values: [
                    {lk_option: "Level1", lk_value: "1"},
                    {lk_option: "Level2", lk_value: "2"},
                    {lk_option: "Level3", lk_value: "3", lk_selected: "yes"}
                ]
            },
            {
                filterName: "Language", "filterType": "text", field: "language", filterLabel: "Language code (ajax data)",
                excluded_operators: ["in", "not_in", "less", "less_or_equal", "greater", "greater_or_equal"],
                filter_interface: [
                    {
                        filter_element: "select"
                    }
                ],
                lookup_values_ajax_url: "ajax/ajax_languages.php"
            },
            {
                filterName: "Company", "filterType": "number", "numberType": "integer", field: "company", filterLabel: "Company",
                excluded_operators: ["in", "not_in", "less", "less_or_equal", "greater", "greater_or_equal"],
                filter_interface: [
                    {
                        filter_element: "select"
                    }
                ],
                lookup_values: [
                    {lk_option: "Company1", lk_value: "1"},
                    {lk_option: "Company2", lk_value: "2"},
                    {lk_option: "Company3", lk_value: "3", lk_selected: "yes"}
                ]
            },
            {
                filterName: "Country", "filterType": "text", field: "country", filterLabel: "Country code",
                excluded_operators: ["in", "not_in", "less", "less_or_equal", "greater", "greater_or_equal"],
                filter_interface: [
                    {
                        filter_element: "input",
                        filter_element_attributes: {type: "text", disabled: "disabled", style: "width: 80px; display: inline-block;"}
                    },
                    {
                        filter_element: "input",
                        filter_element_attributes: {type: "text", style: "width: 120px; margin-left: 5px; display: inline-block;"},
                        filter_widget: "autocomplete",
                        filter_widget_properties: {
                            source: "ajax/ajax_countries.php",
                            minLength: 1,
                            select: function(event, ui) {
                                $(this).prevAll("input").val(ui.item.id);
                            },
                            // mustMatch implementation
                            change: function(event, ui) {
                                if(ui.item == null) {
                                    $(this).val('');
                                    $(this).prevAll("input").val('');
                                }
                            }
                        },
                        returns_no_value: "yes"
                    }
                ]
            }
        ],
 
        onValidationError: function(event, data) {
            alert(data["err_description"] + ' (' + data["err_code"] + ')');
            if(data.hasOwnProperty("elem_filter")) {
                data.elem_filter.focus();
            }
        }
 
    });
 
});
</script>
<body>
<div id="demo_rules1"></div>
</body>
