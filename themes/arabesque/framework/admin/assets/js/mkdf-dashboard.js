(function ($) {
    "use strict";

    var dashboard = {};

    $(document).ready(mkdfOnDocumentReady);
    $(window).on('load', mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    /**
     * All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfDashboardInitDatePicker();
        mkdfDashboardUploadImages();
        mkdfDashboardInitGeocomplete();
        mkdfDashboardRemoveMedia();
        mkdfDashboardSelect2();
        mkdfInitColorpicker();
        //mkdfDashboardRepeater();
        mkdfInitIconSelectChange();
        mkdfDashboardRepeater.rowRepeater.init();
        mkdfDashboardRepeater.rowInnerRepeater.init();
        mkdfDashboardInitSortable();
    }

    /**
     * All functions to be called on $(window).on('load', ) should be in this function
     */
    function mkdfOnWindowLoad() {
    }

    /**
     * All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {
    }

    /**
     * All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {
    }

    function mkdfDashboardInitDatePicker() {
        $(".mkdf-dashboard-input.datepicker").datepicker({dateFormat: "MM dd, yy"});
    }

    function mkdfInitColorpicker() {
        $('.mkdf-dashboard-color-field').wpColorPicker();
    }

    function mkdfInitIconSelectChange() {
        $(document).on('change', 'select.icon-dependence', function (e) {
            var valueSelected = this.value.replace(/ /g, ''),
                parentSection = $(this).parents('.mkdf-dashboard-icon-holder');

            parentSection.find('.mkdf-icon-collection-holder').fadeOut();
            parentSection.find('.mkdf-icon-collection-holder[data-icon-collection="' + valueSelected + '"]').fadeIn();
        });
    }

    var mkdfDashboardRepeater = function () {
        var repeaterHolder = $('.mkdf-dashboard-repeater-wrapper'),
            numberOfRows;

        var rowRepeater = function () {

            var addNewRow = function (holder) {
                var $addButton = holder.find('.mkdf-dashboard-repeater-add a');
                var templateName = holder.find('.mkdf-dashboard-repeater-wrapper-inner').data('template');
                var $repeaterContent = holder.find('.mkdf-dashboard-repeater-wrapper-inner');
                var repeaterTemplate = wp.template('mkdf-dashboard-repeater-template-' + templateName);

                $addButton.on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var $row = $(repeaterTemplate({
                        rowIndex: getLastRowIndex(holder) || 0
                    }));

                    $repeaterContent.append($row);
                    var new_holder = $row.find('.mkdf-dashboard-repeater-inner-wrapper');
                    mkdfDashboardRepeater.rowInnerRepeater.addNewRowInner(new_holder);
                    mkdfDashboardRepeater.rowInnerRepeater.removeRowInner(new_holder);
                    mkdfDashboardInitSortable();
                    mkdfDashboardInitDatePicker();
                    mkdfDashboardUploadImages();
                    mkdfDashboardRemoveMedia();
                    mkdfDashboardSelect2();
                    mkdfInitColorpicker();
                    mkdfInitIconSelectChange();
                    numberOfRows += 1;

                });
            };

            var removeRow = function (holder) {

                var repeaterContent = holder.find('.mkdf-dashboard-repeater-wrapper-inner');
                repeaterContent.on('click', '.mkdf-clone-remove', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if (!window.confirm('Are you sure you want to remove this section?')) {
                        return;
                    }

                    var $rowParent = $(this).parents('.mkdf-dashboard-repeater-fields-holder');
                    $rowParent.remove();

                    decrementNumberOfRows();

                });
            };

            var getLastRowIndex = function (holder) {
                var $repeaterContent = holder.find('.mkdf-dashboard-repeater-wrapper-inner');
                var fieldsCount = $repeaterContent.find('.mkdf-dashboard-repeater-fields-holder').length;

                return fieldsCount;
            };

            var decrementNumberOfRows = function () {
                if (numberOfRows <= 0) {
                    return;
                }

                numberOfRows -= 1;
            }
            var setNumberOfRows = function (holder) {
                numberOfRows = holder.find('.mkdf-dashboard-repeater-fields-holder').length;

            }
            var getNumberOfRows = function () {
                return numberOfRows;
            }

            return {
                init: function () {
                    var repeaterHolder = $('.mkdf-dashboard-repeater-wrapper');

                    repeaterHolder.each(function () {
                        setNumberOfRows($(this));
                        addNewRow($(this));
                        removeRow($(this));
                    });
                },
                numberOfRows: getNumberOfRows
            }
        }();

        var rowInnerRepeater = function () {
            var repeaterInnerHolder = $('.mkdf-dashboard-repeater-inner-wrapper');


            var addNewRowInner = function (holder) {

                //var repeaterInnerContent = holder.find('.mkdf-dashboard-repeater-inner-wrapper-inner');
                var templateInnerName = holder.find('.mkdf-dashboard-repeater-inner-wrapper-inner').data('template');
                var rowInnerTemplate = wp.template('mkdf-dashboard-repeater-inner-template-' + templateInnerName);
                holder.on('click', '.mkdf-inner-clone', function (e) {

                    e.preventDefault();
                    e.stopPropagation();

                    var $clickedButton = $(this);
                    var $parentRow = $clickedButton.parents('.mkdf-dashboard-repeater-fields-holder').first();

                    var parentIndex = $parentRow.data('index');

                    var $rowInnerContent = $clickedButton.parent().prev();

                    var lastRowInnerIndex = $parentRow.find('.mkdf-dashboard-repeater-inner-fields-holder').length;

                    var $repeaterInnerRow = $(rowInnerTemplate({
                        rowIndex: parentIndex,
                        rowInnerIndex: lastRowInnerIndex
                    }));

                    $rowInnerContent.append($repeaterInnerRow);
                    mkdfTinyMCE($repeaterInnerRow, lastRowInnerIndex);
                });
            };

            var removeRowInner = function (holder) {
                var repeaterInnerContent = holder.find('.mkdf-dashboard-repeater-inner-wrapper-inner');
                repeaterInnerContent.on('click', '.mkdf-clone-inner-remove', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if (!confirm('Are you sure you want to remove section?')) {
                        return;
                    }

                    var $removeButton = $(this);
                    var $parent = $removeButton.parents('.mkdf-dashboard-repeater-inner-fields-holder');

                    $parent.remove();
                });
            };

            return {
                init: function () {
                    var repeaterInnerHolder = $('.mkdf-dashboard-repeater-inner-wrapper');
                    repeaterInnerHolder.each(function () {
                        addNewRowInner($(this));
                        removeRowInner($(this));
                    });

                },
                addNewRowInner: addNewRowInner,
                removeRowInner: removeRowInner
            }
        }();

        return {
            rowRepeater: rowRepeater,
            rowInnerRepeater: rowInnerRepeater
        }
    }();

    function mkdfDashboardInitSortable() {
        $('.mkdf-dashboard-repeater-wrapper-inner.sortable').sortable();
        $('.mkdf-dashboard-repeater-inner-wrapper-inner.sortable').sortable();
    }


    function mkdfDashboardInitGeocomplete() {
        var geo_inputs = $(".mkdf-dashboard-address-field");

        if (geo_inputs.length && !mkdf.body.hasClass('mkdf-empty-google-api')) {
            geo_inputs.each(function () {
                var geo_input = $(this),
                    reset = geo_input.find("#reset"),
                    inputField = geo_input.find('input'),
                    mapField = geo_input.find('.map_canvas'),
                    countryLimit = geo_input.data('country'),
                    latFieldName = geo_input.data('lat-field'),
                    latField = $("input[name=" + latFieldName + "]"),
                    longFieldName = geo_input.data('long-field'),
                    longField = $("input[name=" + longFieldName + "]"),
                    initialAddress = inputField.val(),
                    initialLat = latField.val(),
                    initialLong = longField.val();

                latField.attr('data-geo', 'lat');
                longField.attr('data-geo', 'lng');

                inputField.geocomplete({
                    map: mapField,
                    details: ".mkdf-dashboard-address-elements",
                    detailsAttribute: "data-geo",
                    types: ["geocode", "establishment"],
                    country: countryLimit,
                    markerOptions: {
                        draggable: true
                    }
                });

                inputField.bind("geocode:dragged", function (event, latLng) {
                    latField.val(latLng.lat());
                    longField.val(latLng.lng());
                    $("#reset").show();
                    var map = inputField.geocomplete("map");
                    map.panTo(latLng);
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({'latLng': latLng}, function (results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                var road = results[0].address_components[1].short_name;
                                var town = results[0].address_components[2].short_name;
                                var county = results[0].address_components[3].short_name;
                                var country = results[0].address_components[4].short_name;
                                inputField.val(road + ' ' + town + ' ' + county + ' ' + country);
                            }
                        }
                    });
                });

                inputField.on('focus', function () {
                    var map = inputField.geocomplete("map");
                    google.maps.event.trigger(map, 'resize')
                });
                reset.on("click", function () {
                    inputField.geocomplete("resetMarker");
                    inputField.val(initialAddress);
                    latField.val(initialLat);
                    longField.val(initialLong);
                    $("#reset").hide();
                    return false;
                });

                $(window).on("load", function () {
                    inputField.trigger("geocode");
                })
            });
        }
    }

    function mkdfDashboardUploadImages() {
        var galleries = $('.mkdf-dashboard-gallery-uploader');

        if (galleries.length) {
            galleries.each(function () {
                var thisGallery = $(this),
                    inputButton = thisGallery.find('.mkdf-dashboard-gallery-upload-hidden'),
                    uploadButton = thisGallery.find('.mkdf-dashboard-gallery-upload'),
                    thisGalleryImageHolder = thisGallery.parents('.mkdf-dashboard-gallery-holder').find('.mkdf-dashboard-gallery-images-holder');

                if (!uploadButton.hasClass("mkdf-binded")) {

                    inputButton.on("change", function (e) {
                        var filesNumber = e.target.files.length;

                        thisGalleryImageHolder.empty();

                        for (var i = 0, file; file = e.target.files[i]; i++) {

                            var reader = new FileReader();

                            // Closure to capture the file information.
                            reader.onload = (function (theFile) {
                                return function (e) {
                                    if ($.inArray(theFile.type, ["image/gif", "image/jpeg", "image/png"]) !== -1) {
                                        thisGalleryImageHolder.append('<li class="mkdf-dashboard-gallery-image"><img src="' + e.target.result + '" title="' + escape(theFile.name) + '"/></li>');
                                    } else {
                                        thisGalleryImageHolder.append('<li class="mkdf-dashboard-gallery-image"><span class="mkdf-dashboard-input-text">' + escape(theFile.name) + '</span></li>');
                                    }
                                };
                            })(file);

                            // Read in the image file as a data URL.
                            reader.readAsDataURL(file);
                        }
                        ;
                    });

                    uploadButton.on("click", function (e) {
                        e.preventDefault();

                        inputButton.trigger("click");
                    });
                    uploadButton.addClass("mkdf-binded");
                }

            });
        }
    }

    function mkdfDashboardRemoveMedia() {
        var removeMediaBttns = $('.mkdf-dashboard-remove-image');

        if (removeMediaBttns.length) {
            removeMediaBttns.each(function () {
                var thisRemoveMedia = $(this),
                    removeImagesHolder = thisRemoveMedia.parents('.mkdf-dashboard-gallery-holder').find('.mkdf-dashboard-gallery-images-holder'),
                    inputHiddenValue = thisRemoveMedia.siblings('.mkdf-dashboard-media-hidden');


                if (!thisRemoveMedia.hasClass("mkdf-binded")) {
                    thisRemoveMedia.on("click", function (e) {
                        e.preventDefault();

                        inputHiddenValue.val('');

                        removeImagesHolder.empty();

                    });

                    thisRemoveMedia.addClass("mkdf-binded");
                }
            });
        }
    }


    function mkdfDashboardSelect2() {
        if ($('select.mkdf-select2').length) {
            $('select.mkdf-select2').select2({
                allowClear: true
            });
        }
    }

})(jQuery);