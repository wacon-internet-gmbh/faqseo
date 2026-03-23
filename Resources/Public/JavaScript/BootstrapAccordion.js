class BootstrapAccordion {
    /**
     * Der Konstruktor wird aufgerufen, wenn die Klasse instanziiert wird.
     * Er startet direkt die Initialisierung.
     */
    constructor() {
        this.init();
    }

    /**
     * Sucht alle Trigger-Buttons und fügt die Klick-Events hinzu.
     */
    init() {
        // Finde alle Elemente, die als Bootstrap-Collapse-Trigger fungieren
        const triggers = document.querySelectorAll('[data-bs-toggle="collapse"]');

        triggers.forEach(trigger => {
            trigger.addEventListener('click', (event) => {
                // Verhindere das Standardverhalten (z.B. bei <a> Tags)
                event.preventDefault();
                // Rufe die Toggle-Logik für diesen spezifischen Button auf
                this.toggle(trigger);
            });
        });
    }

    /**
     * Führt das Auf- und Zuklappen aus und beachtet Parent-Container.
     * @param {HTMLElement} trigger - Der angeklickte Button
     */
    toggle(trigger) {
        // 1. Ziel-Element ermitteln (der Container, der aufklappen soll)
        const targetSelector = trigger.getAttribute('data-bs-target');
        if (!targetSelector) return;

        const targetElement = document.querySelector(targetSelector);
        if (!targetElement) return;

        // 2. Prüfen, ob das Ziel-Element aktuell geöffnet ist
        const isOpen = targetElement.classList.contains('show');

        // 3. Akkordeon-Logik: Andere offene Elemente schließen, falls ein Parent definiert ist
        const parentSelector = targetElement.getAttribute('data-bs-parent');
        if (parentSelector) {
            const parent = document.querySelector(parentSelector);
            if (parent) {
                // Finde alle aktuell geöffneten Inhalte im selben Parent
                const openElements = parent.querySelectorAll('.collapse.show');

                openElements.forEach(el => {
                    // Wenn es nicht das Element ist, das wir gerade angeklickt haben -> schließen
                    if (el !== targetElement) {
                        el.classList.remove('show');

                        // Finde den Button, der zu diesem Container gehört, und setze ihn zurück
                        const relatedTrigger = parent.querySelector(`[data-bs-target="#${el.id}"]`);
                        if (relatedTrigger) {
                            relatedTrigger.setAttribute('aria-expanded', 'false');
                            relatedTrigger.classList.add('collapsed');
                        }
                    }
                });
            }
        }

        // 4. Das aktuell angeklickte Element umschalten (Toggle)
        if (isOpen) {
            // Wenn offen -> schließen
            targetElement.classList.remove('show');
            trigger.setAttribute('aria-expanded', 'false');
            trigger.classList.add('collapsed');
        } else {
            // Wenn zu -> öffnen
            targetElement.classList.add('show');
            trigger.setAttribute('aria-expanded', 'true');
            trigger.classList.remove('collapsed');
        }
    }
}

// Sobald das HTML-Dokument vollständig geladen ist, starten wir die Klasse
document.addEventListener('DOMContentLoaded', () => {
    new BootstrapAccordion();
});
