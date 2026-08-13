/**
 * Keystone Recomposition - Interactive Calculators Engine
 * Real-time math for GLP-1 KwikPen clicks & FDA Category 1 Peptide Reconstitution
 * Stamped: August 2026
 */

document.addEventListener('DOMContentLoaded', function () {
    // =========================================================================
    // 1. GLP-1 KWIKPEN CLICK CALCULATOR
    // =========================================================================
    const glp1Container = document.getElementById('glp1-calculator');
    if (glp1Container) {
        let currentPenStrength = 5.0; // default 5.0 mg pen
        let currentClicks = 30; // default 30 clicks

        const strengthBtns = glp1Container.querySelectorAll('.strength-btn');
        const clickSlider = document.getElementById('click-slider');
        const clickDisplay = document.getElementById('click-val-display');
        const targetDoseInput = document.getElementById('target-dose-input');
        const calcClicksBtn = document.getElementById('calc-clicks-btn');

        const weeklyDoseInput = document.getElementById('weekly-dose-input');
        const calc5dayBtn = document.getElementById('calc-5day-btn');

        // Result DOM Elements
        const resDeliveredMg = document.getElementById('res-delivered-mg');
        const resDeliveredMl = document.getElementById('res-delivered-ml');
        const resDoseFraction = document.getElementById('res-dose-fraction');
        const resSingleClick = document.getElementById('res-single-click');
        const resCartridgeDoses = document.getElementById('res-cartridge-doses');

        const res5dayDose = document.getElementById('res-5day-dose');
        const resSplitDose = document.getElementById('res-split-dose');
        const resTroughRetention = document.getElementById('res-trough-retention');

        function updateGlp1Math() {
            // Formula: Delivered Dose = Clicks * (Strength / 60)
            const deliveredMg = (currentClicks * (currentPenStrength / 60)).toFixed(2);
            const deliveredMl = (currentClicks * 0.01).toFixed(2);
            const syringeUnits = Math.round(currentClicks);
            const fraction = ((currentClicks / 60) * 100).toFixed(1);
            const singleClickMg = (currentPenStrength / 60).toFixed(4);
            const remainingDoses = currentClicks > 0 ? (240 / currentClicks).toFixed(1) : '∞';

            clickDisplay.textContent = currentClicks + ' Clicks';
            resDeliveredMg.textContent = deliveredMg + ' mg';
            resDeliveredMl.textContent = deliveredMl + ' mL (' + syringeUnits + ' units)';
            resDoseFraction.textContent = fraction + '% of full dose';
            resSingleClick.textContent = singleClickMg + ' mg / click';
            resCartridgeDoses.textContent = remainingDoses + ' doses at this setting';
        }

        // Strength Button Clicks
        strengthBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                strengthBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentPenStrength = parseFloat(this.getAttribute('data-mg'));
                updateGlp1Math();
            });
        });

        // Slider Changes
        if (clickSlider) {
            clickSlider.addEventListener('input', function () {
                currentClicks = parseInt(this.value, 10);
                updateGlp1Math();
            });
        }

        // Calculate Clicks from Target Dose
        if (calcClicksBtn && targetDoseInput) {
            calcClicksBtn.addEventListener('click', function () {
                const targetMg = parseFloat(targetDoseInput.value);
                if (isNaN(targetMg) || targetMg <= 0) return;
                
                // Formula: Required Clicks = (Target / Strength) * 60
                const calculatedClicks = Math.min(60, Math.max(1, Math.round((targetMg / currentPenStrength) * 60)));
                currentClicks = calculatedClicks;
                if (clickSlider) clickSlider.value = calculatedClicks;
                updateGlp1Math();
            });
        }

        // 5-Day Scaler
        function update5DayScaler() {
            const weeklyMg = parseFloat(weeklyDoseInput.value);
            if (isNaN(weeklyMg) || weeklyMg <= 0) return;

            // Tirzepatide 5-day steady-state AUC formula: Weekly Dose * (5 / 7)
            const fiveDayMg = (weeklyMg * (5 / 7)).toFixed(2);
            const splitMg = (weeklyMg * 0.5).toFixed(2);

            res5dayDose.textContent = fiveDayMg + ' mg every 5 days';
            resSplitDose.textContent = splitMg + ' mg every 3.5 days';
            resTroughRetention.textContent = '50.0% retention (vs 37.9% weekly)';
        }

        if (calc5dayBtn && weeklyDoseInput) {
            calc5dayBtn.addEventListener('click', update5DayScaler);
            weeklyDoseInput.addEventListener('input', update5DayScaler);
        }

        // Initial Run
        updateGlp1Math();
        update5DayScaler();
    }

    // =========================================================================
    // 2. PEPTIDE RECONSTITUTION CALCULATOR
    // =========================================================================
    const pepContainer = document.getElementById('peptide-calculator');
    if (pepContainer) {
        let currentVialMg = 5; // default 5 mg vial
        let currentBacMl = 2.0; // default 2.0 mL BAC water
        let currentTargetMcg = 250; // default 250 mcg dose

        const vialBtns = pepContainer.querySelectorAll('.vial-btn');
        const bacSlider = document.getElementById('bac-slider');
        const bacDisplay = document.getElementById('bac-val-display');
        const targetDoseInput = document.getElementById('peptide-target-dose');

        // Results
        const resSyringeUnits = document.getElementById('res-syringe-units');
        const resPepVolume = document.getElementById('res-pep-volume');
        const resPepConcentration = document.getElementById('res-pep-concentration');
        const resPepUnitValue = document.getElementById('res-pep-unit-value');
        const resPepTotalDoses = document.getElementById('res-pep-total-doses');

        const syringeFillBar = document.getElementById('syringe-fill-bar');
        const syringeCaptionUnits = document.getElementById('syringe-caption-units');

        function updatePeptideMath() {
            // Formula: Concentration (mcg/mL) = (Vial mg * 1000) / BAC mL
            const totalMcg = currentVialMg * 1000;
            const concentrationMcgPerMl = totalMcg / currentBacMl;
            const concentrationMgPerMl = (currentVialMg / currentBacMl).toFixed(1);

            // Formula: Volume (mL) = Target mcg / Concentration
            const volumeMl = currentTargetMcg / concentrationMcgPerMl;

            // Formula: Syringe Units on U-100 (100 units = 1 mL) = Volume * 100
            const units = (volumeMl * 100).toFixed(1);
            const mcgPerUnit = (concentrationMcgPerMl / 100).toFixed(1);
            const totalDoses = Math.floor(totalMcg / currentTargetMcg);

            bacDisplay.textContent = currentBacMl.toFixed(1) + ' mL';
            resSyringeUnits.textContent = units + ' Units';
            resPepVolume.textContent = volumeMl.toFixed(3) + ' mL';
            resPepConcentration.textContent = Math.round(concentrationMcgPerMl).toLocaleString() + ' mcg/mL (' + concentrationMgPerMl + ' mg/mL)';
            resPepUnitValue.textContent = mcgPerUnit + ' mcg / unit';
            resPepTotalDoses.textContent = totalDoses + ' doses at ' + currentTargetMcg + ' mcg';

            // Update Syringe Fill Graphic
            if (syringeFillBar) {
                const fillPercent = Math.min(100, Math.max(0, parseFloat(units)));
                syringeFillBar.style.width = fillPercent + '%';
            }
            if (syringeCaptionUnits) {
                syringeCaptionUnits.textContent = units + ' Units';
            }
        }

        // Vial Buttons
        vialBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                vialBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentVialMg = parseFloat(this.getAttribute('data-vial'));
                updatePeptideMath();
            });
        });

        // BAC Slider
        if (bacSlider) {
            bacSlider.addEventListener('input', function () {
                currentBacMl = parseFloat(this.value);
                updatePeptideMath();
            });
        }

        // Target Dose Input
        if (targetDoseInput) {
            targetDoseInput.addEventListener('input', function () {
                const val = parseFloat(this.value);
                if (!isNaN(val) && val > 0) {
                    currentTargetMcg = val;
                    updatePeptideMath();
                }
            });
        }

        // Initial Run
        updatePeptideMath();
    }
});
