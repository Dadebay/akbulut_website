(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? factory(exports) :
        typeof define === 'function' && define.amd ? define(['exports'], factory) :
            (global = global || self, factory(global.tk = {}));
}(this, function (exports) { 'use strict';

    var fp = typeof window !== "undefined" && window.flatpickr !== undefined
        ? window.flatpickr
        : {
            l10ns: {}
        };
    var Turkmen = {
        weekdays: {
            shorthand: ["Ýek", "Duş", "Siş", "Çar", "Pen", "Ann", "Şen"],
            longhand: [
                "Ýekşenbe",
                "Duşenbe",
                "Sişenbe",
                "Çarşenbe",
                "Penşenbe",
                "Anna",
                "Şenbe",
            ]
        },
        months: {
            shorthand: [
                "Ýan",
                "Few",
                "Mar",
                "Apr",
                "MaÝ",
                "Iýun",
                "Iýul",
                "Auw",
                "Sep",
                "Okt",
                "Now",
                "Dek",
            ],
            longhand: [
                "Ýanwar",
                "Fewral",
                "Mart",
                "Aprel",
                "Maý",
                "Iýun",
                "Iýul",
                "Awgust",
                "Sentýabr",
                "Oktýabr",
                "Noýabr",
                "Dekabr",
            ]
        },
        firstDayOfWeek: 1,
        ordinal: function () {
            return "";
        },
        rangeSeparator: " - ",
        weekAbbreviation: "Hp",
        scrollTitle: "Artdyrmak üçin geçiriň",
        toggleTitle: "Açmak we ýapmak",
        amPM: ["ÖÖ", "ÖS"],
        yearAriaLabel: "Ýyl"
    };
    fp.l10ns.tk = Turkmen;
    var tk = fp.l10ns;

    exports.Turkmen = Turkmen;
    exports.default = tk;

    Object.defineProperty(exports, '__esModule', { value: true });

}));