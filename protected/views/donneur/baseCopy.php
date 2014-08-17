<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Yii::app()->clientscript
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/kendo.web.min.js', CClientScript::POS_END);
$x = Donneur::model()->count() > 8 ? 8 : Donneur::model()->count();
?>
<!-- kendo ui framework css file -->
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl . '/css/metrotheme.min.css'; ?>"/>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl . '/css/kendo.common.min.css'; ?>"/>


<div id="grid"></div> 

<script>
    var groupe = [{
            "value": "O+",
            "text": "O+"
        }, {
            "value": "O-",
            "text": "O-"
        }, {
            "value": "A+",
            "text": "A+"
        }, {
            "value": "A-",
            "text": "A-"
        }, {
            "value": "B+",
            "text": "B+"
        }, {
            "value": "B-",
            "text": "B-"
        }, {
            "value": "AB+",
            "text": "AB+"
        }, {
            "value": "AB-",
            "text": "AB-"
        }];
    var sexe = [{
            "value": "M",
            "text": "M"
        }, {
            "value": "F",
            "text": "F"
        }];
    var vehicule = [{
            "value": "Oui",
            "text": "Oui"
        }, {
            "value": "Non",
            "text": "Non"
        }];
    $(document).ready(function() {
        $("#grid").kendoGrid({
            dataSource: {
                transport: {
                    read: "?r=donneur/list",
                    update: {
                        url: "?r=donneur/list",
                        type: "POST"
                    },
                    create: {
                        url: "?r=donneur/test",
                        type: "POST"
                    },
                    destroy: {
                        url: "?r=donneur/list",
                        dataType: "json",
                        type: "DELETE"
                    },
                    parameterMap: function (options, operation) {
                            if (operation != "read") {
                                var d = new Date(options.date_donation);
                                options.date_donation = d.toString("yyyy-MM-dd");                            
                                return options;
                            }
                        }
                },
                // pageSizes: true,
                success: function(html) {
                    alert('successful : ' + html);
                    $("#result").html("Successful");
                },
                error: function(data, errorThrown)
                {
                  //  alert('request failed :' + errorThrown + data.data.length);
                },
                batch: true,
                pageSize: 10,
                schema: {
                    data: "data",
                  /*  total: function(data) {
                        return data.data.length;
                    },*/
                    model: {
                        id: "id",
                        fields: {
                            first_name: {validation: {required: {message: "Le Prénom est obligatoire"}}},
                            last_name: {validation: {required: {message: "Le Nom est obligatoire"}}},
                            age: {field: "age", type: "number", defaultValue: 30, validation: {required: true, min: 18, max: 99}},
                            gender: {validation: {required: true}, defaultValue: "M"},
                            address: {validation: {required: true, minLength: function(input) {
                                        if (input.is("[name=address]")) {
                                            input.attr("data-minLength-msg", "L'adresse est trés court");
                                            return input.val().length >= 6;
                                        }
                                        return true;
                                    }
                                }},
                            vehicle: {defaultValue: "Non"},
                            date_donation: {type: "date", nullable: false},
                            phone: {validation: {required: {message: "Le numéro de téléphone est obligatoire"}}},
                            // date_donation: {},
                            groupe_sangun: {validation: {required: true}, defaultValue: "O+"},
                            email: {validation: {email: {message: "enter un email valide"}
                                }
                            }
                        }
                    }
                }


            },
            pageable: {
                refresh: true,
                pageSizes: 10,
                buttonCount: 5,
                messages: {
                    display: "{0} - {1} de {2} lignes", //{0} is the index of the first record on the page, {1} - index of the last record on the page, {2} is the total amount of records
                    empty: "Vide",
                    page: "Page",
                    of: "de {0}", //{0} is total amount of pages
                    itemsPerPage: "Lignes par page",
                    first: "Première page",
                    previous: "Page precédente",
                    next: "Page suivante",
                    last: "Dernière page",
                    refresh: "Actualiser"
                }
            },
            reorderable: true,
            resizable: true,
            selectable: "multiple cell",
            scrollable: {mode: "multiple"},
            navigatable: true,
            height: 600,
            sortable: true,
            columns: [
                {field: "first_name", title: "Prénom", aggregates: ["count"],
                    groupFooterTemplate: "total: #: count #"},
                {field: "last_name", title: "Nom"},
                {field: "age", title: "Age", width: "50px"},
                {field: "gender", title: "Sexe", values: sexe, width: "50px"},
                {field: "groupe_sangun", title: "GS", values: groupe, width: "50px"},
                {field: "address", title: "Adresse de proximité", width: "230px"},
                {field: "vehicle", title: "Vihiculé", values: vehicule, width: "50px"},
                {field: "date_donation", title: "date de donnation", type: "date", format: '{0:yyyy-MM-dd}', width: "100px"},
                {field: "phone", title: "Téléphone"},
                {field: "email", title: "mail", width: "180px;"},
                {command: [{name: "edit", text: {edit: "Modif", cancel: "Annuler", update: "Valider"}},
                        {name: "destroy", text: "Suppr"}], title: "&nbsp;", width: "164px"}
            ],
            groupable: {
                messages: {
                    empty: "Glisser une tête de column ici pour grouper par pour à elle"
                }
            },
            toolbar: [{name: "create", text: "Ajouter un donneur"}], // adds save and cancel buttons
            // editable: true,
            editable: {
                mode: "popup",
                confirmation: "êtes vous que vous veullez supprimer ce donneur?",
                //   template: kendo.template($("#popup-editor").html()),
            },
            filterable: {
                messages: {
                    info: "Afficher les éléments avec la contrainte:", // sets the text on top of the filter menu
                    filter: "Filtrer", // sets the text for the "Filter" button
                    clear: "Vider", // sets the text for the "Clear" button

                    // when filtering boolean numbers
                    isTrue: "Vrai", // sets the text for "isTrue" radio button
                    isFalse: "Faut", // sets the text for "isFalse" radio button

                    //changes the text of the "And" and "Or" of the filter menu
                    and: "Et",
                    or: "Oui"
                },
                operators: {
                    //filter menu for "string" type columns
                    string: {
                        eq: "Egale à",
                        neq: "N'égale pas à",
                        startswith: "Commencer par",
                        contains: "Contient",
                        endswith: "Finir par"
                    },
                    //filter menu for "number" type columns
                    number: {
                        eq: "Egale à",
                        neq: "N'égale pas à",
                        gte: "Est supérieure ou égale à",
                        gt: "Est supérieure à",
                        lte: "Est inférieure ou égale à",
                        lt: "Est inférieure à"
                    },
                    //filter menu for "date" type columns
                    date: {
                        eq: "Egale à",
                        neq: "N'égale pas à",
                        gte: "Est supérieure ou égale à",
                        gt: "Est supérieure à",
                        lte: "Est inférieure ou égale à",
                        lt: "Est inférieure à"
                    },
                    //filter menu for foreign key values
                    enums: {
                        eq: "Egale à",
                        neq: "N'égale pas à",
                    }
                }
            },
            columnMenu: {
                messages: {
                    sortAscending: "Tri Ascendant",
                    sortDescending: "Tri Descendant",
                    filter: "Filtrer",
                    columns: "Colonnes"
                }
            }

            // editable: "popup"
        });
    }

    );

</script> <?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

