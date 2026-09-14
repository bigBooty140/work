Vue.filter('currencyFilter', (value) => {
    if (!(value >> 0)) {
        return '';
    }

    const defaultCurrencySettings = {
        delimiterThousand: ',',
        position: '0',
        symbol: '',
    };
    const currencySettings = (
        (
            window.Simulcast
            && window.Simulcast.data
            && window.Simulcast.data.settings
            && window.Simulcast.data.settings.localization
            && window.Simulcast.data.settings.localization.currency
        ) || {}
    );
    let res = '';

    const currencySymbol = currencySettings['symbol'] || defaultCurrencySettings['symbol'];
    const currencyPosition = currencySettings['position'] || defaultCurrencySettings['position'];
    const currencyDelimiterThousand = currencySettings['delimiterThousand']
        || defaultCurrencySettings['delimiterThousand'];
    let currency = Number(value).toFixed();

    while (currency > 999) {
        res = (function (numberIn) {
            let res = String(numberIn);

            while (res.length < 3) {
                res = '0' + res;
            }

            return res;
        }(currency % 1000)) + (res ? (currencyDelimiterThousand + res) : '');
        currency = Math.floor(currency / 1000);
    }

    res = currency + (res ? (currencyDelimiterThousand + res) : '');

    if (Number(currencyPosition) === 0) {
        res = currencySymbol + res;
    } else if (Number(currencyPosition) === 1) {
        res += currencySymbol;
    }

    return res;
});

Vue.filter('hyphenFilter', (value) => {
    let result = String(value);

    result = (
        result
        && Number(result.replace(/\D|,/g, '')) // exclude values $0
    )
        ? value
        : '-';

    return result;
});

/**
 * Convert distance value from  imperial system of units to metric system
 */
Vue.filter('distanceMetric', (value, metricSystem) => {
    const ROYAL_SYSTEM_UNIT = 'mi';
    const METRIC_SYSTEM_UNIT = 'km';
    const DELIMITER = ' ';

    let result = value + DELIMITER + ROYAL_SYSTEM_UNIT;

    metricSystem = metricSystem || METRIC_SYSTEM_UNIT;

    if (METRIC_SYSTEM_UNIT === metricSystem) {
        result = Math.floor(1.60934 * value) + DELIMITER + METRIC_SYSTEM_UNIT;
    }

    return result;
});

/**
 * Filter for language-sensitive number formatting, by default in US English locale.
 */
Vue.filter('formatNumber', (value, localFormat) => {
    let result;

    localFormat = localFormat || 'en-EN';

    try {
        result = new Intl.NumberFormat('en-EN').format(value);
    } catch (e) {
        result = value;
    }

    return result;
});
