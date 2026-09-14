(function(){
    var selectorsArray = [
        '[widget="date_input"] select[name^="date_input"][name$="_y"]',
        '[widget="selectchain"] select[name^="selectchain-"][name$="_year"]',
        '[widget="date_input"] select[name="birthdate_y"]',
        '[widget="date_input"] select[name="drivedate_c_y"]'
    ];

    var currentDate = new Date(),
        chainRangeMinDate = 1959,
        simpleInputMinDate = 1900,
        yearNow = currentDate.getFullYear(),
        yearMax = yearNow + 1;

    $(document).bind({
        'update_layout.maf update_layout.mafr': function () {
            correctDateList(selectorsArray, $('#fbl-canvas'));
        },
        'update_layout.mapfb': function () {
            correctDateList(selectorsArray, $('.modul-r-formbuilder'));
            correctDateList(selectorsArray, $('.fbl_main'));
        }
    });

    function correctDateList(selectors, $contain) {
        var options, j, i;

        for(i=0; i < selectors.length; i++) {
            $(selectors[i], $contain).each(function(){
                var $this = $(this),
                    isChain = (selectors[i].indexOf('selectchain') >= 0),
                    yearMin = (isChain ? chainRangeMinDate : simpleInputMinDate),

                    firstChildText = $this.children().eq(0).text(),
                    lastChildText = $this.children().eq(-1).text();

                if (firstChildText < yearMax || lastChildText < yearMax) {
                    options = (isChain ? "<option selected value=''> Any Year </option>" : '');

                    if (firstChildText > lastChildText) {
                        // descending sorting
                        for (j = yearMax; j > yearMin; j--) {
                            options += '<option ' + ( (j == yearNow && !isChain) ? "selected" : "" ) + ' value="' + j + '">' + j + '</option>';
                        }
                    }
                    else {
                        // ascending sorting
                        for (j = yearMin; j <= yearMax; j++) {
                            options += '<option ' + ( (j == yearMin && !isChain) ? "selected" : "" ) + 'value="' + j + '">' + j + '</option>';
                        }
                    }

                    $this.html(options);
                }
            });
        }
    }
})();