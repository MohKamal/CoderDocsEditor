jQuery(function($) {
    var panelList = $('#draggablePanelList');

    panelList.sortable({
        // Only make the .panel-heading child elements support dragging.
        // Omit this to make then entire <li>...</li> draggable.
        handle: '.dpanel-heading',
        update: function() {
            $('.dpanel', panelList).each(function(index, elem) {
                var $listItem = $(elem),
                    newIndex = $listItem.index();

                // Persist the new indices.
                var id = $(elem).attr("data-id");
                var pre = getObject(sections, id);
                pre.order = newIndex + 1;
                displayHtml();
            });
        }
    });
});


var preSections = [];
var preElements = [];
var sections = [];
var menuItems = [];
var editing_section_html_id = -1;
var editing_element_html_id = -1;

$(document).ready(function() {
    $("#editor-area").hide();
    var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
        lineNumbers: true,
        mode: "xml",
    });

    $.get("/pre-sections", function(data, status) {
        $.each(data, function(k, v) {
            var pre = {
                "id": v.id,
                "title": v.title,
                "html": v.html,
                "type": "section"
            };
            preSections.push(pre);
            var item = `<li class="panel panel-primary">
                                <div class="panel-heading collapsed" data-toggle="collapse" data-target="#psection-${v.id}">${v.title}
                                    <a class="btn icon-btn btn-success add-section" data-id="${v.id}" style="padding: 0.2rem 0.6rem;" href="javascript:void(0)">
                                        <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success">
                                        </span>
                                    </a>
                                </div>
                                <div class="panel-body collapse" id="psection-${v.id}">
                                    <div class="card-body">
                                        <div class="row text-center ">
                                            <div class="col-md-12 mt-2" style="font-size:8px;">
                                                ${v.html}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>`;
            $("#Templates").append(item);
        });

    });

    $.get("/pre-elements", function(data, status) {
        $.each(data, function(k, v) {
            var pre = {
                "id": v.id,
                "title": v.title,
                "html": v.html,
                "type": "element"
            };
            preElements.push(pre);
        });
        addToElementList();
    });

    $('body').on('click', '.add-section', function() {
        var code_id = $(this).attr('data-id');
        var pre = getObject(preSections, code_id);
        var section = {
            "id": sections.length + 1,
            "title": pre.title,
            "html": pre.html,
            "type": "section",
            "order": sections.length,
            "slug": convertToSlug(pre.title),
            "subElements": []
        };
        sections.push(section);
        addToSectionList();
        displayHtml();
        addToElementList();
    });

    $('body').on('click', '.remove-section', function() {
        var code_id = $(this).attr('data-id');
        removeElement(sections, code_id);
        addToSectionList();
        displayHtml();
        addToElementList();
    });

    $('body').on('click', '.remove-element', function() {
        var parentid = $(this).attr('data-parentid');
        var id = $(this).attr('data-id');
        var pre = getObject(sections, parentid);
        var element = getObject(pre.subElements, id);
        removeElement(pre.subElements, id);
        addToSectionList();
        displayHtml();
        addToElementList();
    });

    $('body').on('click', '.edit-section', function() {
        var code_id = $(this).attr('data-id');
        var pre = getObject(sections, code_id);
        editor.setValue('');
        editor.setValue(pre.html);
        editor.refresh();
        editing_section_html_id = pre.id;
        $("#codeeditor").modal('show');
    });

    $('body').on('click', '.edit-element', function() {
        var parentid = $(this).attr('data-parentid');
        var id = $(this).attr('data-id');
        var pre = getObject(sections, parentid);
        var element = getObject(pre.subElements, id);
        editor.setValue('');
        editor.setValue(element.html);
        editor.refresh();
        editing_section_html_id = pre.id;
        editing_element_html_id = element.id;
        $("#codeeditor").modal('show');
    });

    $('body').on('click', '.add-section-element', function() {
        var code_id = $(this).attr('data-id');
        var pre = getObject(sections, code_id);
        var idElement = $("#select-" + code_id).val();
        var preElement = getObject(preElements, idElement);
        var element = {
            "id": pre.subElements.length + 1,
            "title": preElement.title,
            "html": preElement.html,
            "type": "element",
            "slug": convertToSlug(preElement.title)
        };
        pre.subElements.push(element);
        addToSectionList();
        displayHtml();
        addToElementList();
    });

    $('body').on('click', '.add-element-to-section', function() {
        var code_id = $(this).attr('data-id');
        var select = $("#select-element-" + code_id);
        var value = select.val();
        if (value.includes("|")) {
            var elementid = value.split("|")[0];
            var sectionid = value.split("|")[1];
            var pre = getObject(sections, sectionid);
            var preElement = getObject(preElements, code_id);
            var element = getObject(pre.subElements, elementid);
            var index = element.html.indexOf("<!-- EHTML -->");
            element.html = element.html.slice(0, index) + preElement.html + "\n" + element.html.slice(index);
        } else {
            var pre = getObject(sections, value);
            var preElement = getObject(preElements, code_id);
            var element = {
                "id": pre.subElements.length + 1,
                "title": preElement.title,
                "html": preElement.html,
                "type": "element",
                "slug": convertToSlug(preElement.title)
            };
            pre.subElements.push(element);
        }
        addToSectionList();
        displayHtml();
        addToElementList();
    });

    $('body').on('click', '.add-element-element', function() {
        var code_id = $(this).attr('data-id');
        var value = $("#select-element-" + code_id).val();
        console.log(value);
        var elementid = value.split("|")[0];
        var sectionid = value.split("|")[1];
        var pre = getObject(sections, sectionid);
        var preElement = getObject(preElements, elementid);
        var element = getObject(pre.subElements, code_id);
        var index = element.html.indexOf("<!-- EHTML -->");
        element.html = element.html.slice(0, index) + preElement.html + "\n" + element.html.slice(index);
        addToSectionList();
        displayHtml();
        addToElementList();
    });

    $('body').on('click', '.edit-section-title', function() {
        var code_id = $(this).attr('data-id');
        var pre = getObject(sections, code_id);
        pre.title = $("#section-title-" + code_id).val();
        changeSectionSlug(pre, convertToSlug(pre.title));
        addToSectionList();
        displayHtml();
        addToElementList();
    });

    $('body').on('click', '.edit-element-title', function() {
        var parentid = $(this).attr('data-parentid');
        var id = $(this).attr('data-id');
        var pre = getObject(sections, parentid);
        var element = getObject(pre.subElements, id);
        element.title = $("#element-title-" + id).val();
        changeSectionSlug(element, convertToSlug(element.title));
        addToSectionList();
        displayHtml();
        addToElementList();
    });

    $("#saveCode").on('click', function() {
        if (editing_section_html_id != -1 && editing_element_html_id != -1) {
            $("#codeeditor").modal('hide');
            var pre = getObject(sections, editing_section_html_id);
            var element = getObject(pre.subElements, editing_element_html_id);
            element.html = editor.getValue();
            editing_section_html_id = -1;
            editing_element_html_id = -1;
            displayHtml();
            editor.setValue('');
        } else if (editing_section_html_id != -1 && editing_element_html_id == -1) {
            $("#codeeditor").modal('hide');
            var pre = getObject(sections, editing_section_html_id);
            pre.html = editor.getValue();
            editing_section_html_id = -1;
            displayHtml();
            editor.setValue('');
        }
    });

    $("#closeCode").on('click', function() {
        if (editing_section_html_id != -1) {
            $("#codeeditor").modal('hide');
            editing_section_html_id = -1;
            editing_element_html_id = -1;
            editor.setValue('');
        }
    });

    $("#saveToDb").on('click', function() {
        $.ajax({
            url: "/add-sections",
            type: 'POST',
            data: {
                CSRFName: $('input[name$="CSRFName"]').val(),
                CSRFToken: $('input[name$="CSRFToken"]').val(),
                sections: sections,
                menuitems: menuItems
            },
            success: function(url) {
                window.location.href = url;
            },
            error: function(result) {
                alert('Error');
            }
        });
    });


});

function removeElement(list, id) {
    for (var i = 0; i < list.length; i++) {
        if (parseInt(list[i].id) === parseInt(id)) {
            list.splice(i, 1);
            break;
        }
    }
}

function compare(a, b) {
    if (a.order < b.order) {
        return -1;
    }
    if (a.order > b.order) {
        return 1;
    }
    return 0;
}

function displayHtml() {
    sections.sort(compare);
    var html = '';
    $.each(sections, function(k, v) {
        changeSectionSlug(v, v.slug);
        var temp_html = v.html;
        $.each(v.subElements, function(key, value) {
            changeSectionSlug(value, value.slug);
            var index = temp_html.indexOf("<!-- HTML -->");
            temp_html = temp_html.slice(0, index) + value.html + "\n" + temp_html.slice(index);
        });
        html += temp_html;
    });
    $("#main_wrapper").html(html);
    addToMenu();

}

function addToElementList() {
    $("#ETemplates").html('');
    $.each(preElements, function(k, v) {
        var selectElement = `<select id="select-element-${v.id}" class="form-control">`;
        $.each(sections, function(key, value) {
            selectElement += `<option value="${value.id}">${value.title}</option>`;
            $.each(value.subElements, function(key, ve) {
                selectElement += `<option value="${ve.id}|${value.id}">-- ${ve.title}</option>`;
            });
        });
        selectElement += `</select>`;
        var item = `<li class="panel panel-primary">
                    <div class="panel-heading" data-toggle="collapse" data-target="#pelement-${v.id}">${v.title}
                    </div>
                    <div id="pelement-${v.id}" class="panel-body">
                        <div class="card-body">
                            <div class="row text-center ">
                                <div class="col-md-12 mt-2" style="font-size:6px;">
                                    ${v.html}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                ${selectElement}
                            </div>
                            <div class="col-md-6">
                                <a class="btn icon-btn btn-block btn-success add-element-to-section" data-id="${v.id}" href="javascript:void(0)">
                                    <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-default">
                                    </span> Insert
                                </a>
                            </div>
                        </div>
                    </div>
                </li>`;
        $("#ETemplates").append(item);
    });
}

function addToSectionList() {
    sections.sort(compare);
    $("#draggablePanelList").html('');
    $.each(sections, function(k, v) {
        var selectElement = `<select id="select-${v.id}" class="form-control">`;
        $.each(preElements, function(key, value) {
            selectElement += `<option value="${value.id}">${value.title}</option>`;
        });
        selectElement += `</select>`;
        var subHtml = getSubElementHtml(v);
        var item = `<li class="panel dpanel panel-primary" data-id="${v.id}">
                        <div class="panel-heading dpanel-heading" data-toggle="collapse" data-target="#section-${v.id}">${v.title}
                            <a class="btn icon-btn btn-danger remove-section" data-id="${v.id}" style="padding: 0.2rem 0.6rem;" href="javascript:void(0)">
                                <span class="glyphicon btn-glyphicon glyphicon-remove img-circle text-default">
                                </span>
                            </a>
                        </div>
                        <div class="panel-body" id="section-${v.id}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <input type="text" id="section-title-${v.id}" value="${v.title}" class="form-control" placeholder="Section Title">
                                            </div>
                                            <div class="col-md-6">
                                                <a class="btn icon-btn btn-block btn-warning edit-section-title" data-id="${v.id}" href="javascript:void(0)">
                                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-default">
                                                    </span> Edit
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <a class="btn icon-btn btn-block btn-success edit-section mt-2" data-id="${v.id}" href="javascript:void(0)">
                                            <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-default">
                                            </span> Edit code
                                        </a>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                ${selectElement}
                                            </div>
                                            <div class="col-md-6">
                                                <a class="btn icon-btn btn-block btn-success add-section-element" data-id="${v.id}" href="javascript:void(0)">
                                                    <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-default">
                                                    </span> Add
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    ${subHtml}
                                </div>
                            </div>
                        </div>
                    </li>`;
        $("#draggablePanelList").append(item);
    });
}

function getSubElementHtml(section) {
    if (section.subElements.length < 0)
        return "";
    var html = "";
    $.each(section.subElements, function(k, v) {
        var selectElement = `<select id="select-element-${v.id}" class="form-control">`;
        $.each(preElements, function(key, value) {
            selectElement += `<option value="${value.id}|${section.id}">${value.title}</option>`;
        });
        selectElement += `</select>`;
        var item = `<div class="notice notice-lg notice-sucess col-md-12" data-toggle="collapse" data-target="#subelement-${v.id}">
                        <div class="row" id="subelement-${v.id}>
                            <div class="col-md-8">
                                <strong>${v.title}</strong>
                            </div>
                            <div class="col-md-4">
                                <a class="btn icon-btn btn-danger remove-element" data-parentid="${section.id}" data-id="${v.id}" style="padding: 0.2rem 0.6rem;" href="javascript:void(0)">
                                    <span class="glyphicon btn-glyphicon glyphicon-remove img-circle text-default">
                                    </span>
                                </a>
                            </div>
                            <div class="col-md-12">
                                <a class="btn icon-btn btn-block btn-success edit-element mt-2" data-parentid="${section.id}" data-id="${v.id}" href="javascript:void(0)">
                                    <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-default">
                                    </span> Edit code
                                </a>
                            </div>
                            <div class="col-md-12">
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <input type="text" id="element-title-${v.id}" value="${v.title}" class="form-control" placeholder="Section Title">
                                    </div>
                                    <div class="col-md-6">
                                        <a class="btn icon-btn btn-block btn-warning edit-element-title" data-parentid="${section.id}" data-id="${v.id}" href="javascript:void(0)">
                                            <span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-default">
                                            </span> Edit
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        ${selectElement}
                                    </div>
                                    <div class="col-md-6">
                                        <a class="btn icon-btn btn-block btn-success add-element-element" data-id="${v.id}" href="javascript:void(0)">
                                            <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-default">
                                            </span> Add
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;

        html += item;
    });
    return html;
}

function addToMenu() {
    sections.sort(compare);
    menuItems = [];
    $.each(sections, function(k, v) {
        if (v.html.includes("menu-item")) {
            var item = ` <li class="nav-item section-title"><a class="nav-link scrollto active" href="#${v.slug}"><span class="theme-icon-holder mr-2"><i class="fas fa-map-signs"></i></span>${v.title}</a></li>`;
            menuItems.push(item);
        }
        $.each(v.subElements, function(key, value) {
            if (value.html.includes("menu-item")) {
                var item = `<li class="nav-item"><a class="nav-link scrollto" href="#${value.slug}">${value.title}</a></li>`;
                menuItems.push(item);
            }
        });
    });

    $("#menu-element").html('');
    $.each(menuItems, function(k, v) {
        $("#menu-element").append(v);
    });
}

function getObject(list, id) {
    for (var i = 0; i < list.length; i++) {
        if (parseInt(list[i].id) === parseInt(id)) {
            return list[i];
        }
    }

    return null;
}

function convertToSlug(Text) {
    return Text
        .toLowerCase()
        .replace(/ /g, '-')
        .replace(/[^\w-]+/g, '');
}

function changeSectionSlug(section, slug) {
    if (section.slug == slug)
        return false;
    section.html = section.html.replace('id="' + section.slug + '"', 'id="' + slug + '"');
    section.slug = slug;
    return true;
}