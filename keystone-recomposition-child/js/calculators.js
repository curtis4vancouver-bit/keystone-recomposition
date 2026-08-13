/**
 * Keystone Recomposition - Interactive Calculators Engine
 * Real-time math for GLP-1 KwikPen clicks & FDA Category 1 Peptide Reconstitution
 * Stamped: August 2026 - Wayne Stevenson
 */

document.addEventListener('DOMContentLoaded', function () {
    // =========================================================================
    // 1. GLP-1 KWIKPEN CLICK CALCULATOR (5-Day vs 7-Day & Half-Life Engine)
    // =========================================================================
    const glp1Container = document.getElementById('glp1-calculator');
    if (glp1Container) {
        let currentPenStrength = 5.0; // default 5.0 mg pen
        let currentClicks = 30; // default 30 clicks
        let currentInterval = 5; // default 5-day microdose protocol
        let currentHalfLife = 5.0; // default Tirzepatide (5.0 days)
        let currentCompound = 'tirzepatide';

        const compoundBtns = glp1Container.querySelectorAll('.compound-btn');
        const intervalBtns = glp1Container.querySelectorAll('.interval-btn');
        const strengthBtns = glp1Container.querySelectorAll('.strength-btn');
        const clickSlider = document.getElementById('click-slider');
        const clickDisplay = document.getElementById('click-val-display');
        const targetDoseInput = document.getElementById('target-dose-input');
        const calcClicksBtn = document.getElementById('calc-clicks-btn');
        const targetMatcherHint = document.getElementById('target-matcher-hint');

        // Result DOM Elements
        const resDeliveredMg = document.getElementById('res-delivered-mg');
        const resWeeklyEquivalent = document.getElementById('res-weekly-equivalent');
        const resDeliveredMl = document.getElementById('res-delivered-ml');
        const resSingleClick = document.getElementById('res-single-click');
        const resCartridgeDoses = document.getElementById('res-cartridge-doses');

        const pkDynamicsTitle = document.getElementById('pk-dynamics-title');
        const resActiveSchedule = document.getElementById('res-active-schedule');
        const resTroughRetention = document.getElementById('res-trough-retention');
        const resPeakTrough = document.getElementById('res-peak-trough');
        const resHungerStatus = document.getElementById('res-hunger-status');

        function updateGlp1Math() {
            // Formula: Delivered Dose = Clicks * (Strength / 60)
            const deliveredMg = currentClicks * (currentPenStrength / 60);
            const deliveredMl = currentClicks * 0.01;
            const syringeUnits = Math.round(currentClicks);
            const singleClickMg = currentPenStrength / 60;
            const remainingDoses = currentClicks > 0 ? (240 / currentClicks).toFixed(1) : '∞';

            // Weekly Equivalent Load = Injected Dose * (7 / Interval)
            const weeklyEquivalentMg = deliveredMg * (7 / currentInterval);

            // Pharmacokinetic First-Order Decay: Fraction Remaining = 2^(-Interval / HalfLife)
            const troughFraction = Math.pow(2, -(currentInterval / currentHalfLife));
            const troughPercent = (troughFraction * 100).toFixed(1);
            const peakTroughRatio = (1 / troughFraction).toFixed(2);

            // Update DOM
            clickDisplay.textContent = currentClicks + ' Clicks';
            resDeliveredMg.textContent = deliveredMg.toFixed(2) + ' mg';
            resWeeklyEquivalent.textContent = weeklyEquivalentMg.toFixed(2) + ' mg / week';
            resDeliveredMl.textContent = deliveredMl.toFixed(2) + ' mL (' + syringeUnits + ' units)';
            resSingleClick.textContent = singleClickMg.toFixed(4) + ' mg / click';
            resCartridgeDoses.textContent = remainingDoses + ' shots at this setting';

            if (currentInterval === 5) {
                pkDynamicsTitle.textContent = '⚡ 5-Day Micro-Dose Protocol Dynamics';
                resActiveSchedule.textContent = 'Every 5 Days (⚡ Micro-Dose)';
                resActiveSchedule.style.color = '#C4A265';
                resTroughRetention.textContent = troughPercent + '% Remaining (Stable)';
                resTroughRetention.style.color = '#10B981';
                resPeakTrough.textContent = peakTroughRatio + 'x Fluctuation';
                resHungerStatus.textContent = 'Zero Late Food Noise';
                resHungerStatus.style.color = '#10B981';
            } else {
                pkDynamicsTitle.textContent = '📅 7-Day Standard Schedule Dynamics';
                resActiveSchedule.textContent = 'Every 7 Days (📅 Standard Weekly)';
                resActiveSchedule.style.color = '#9CA3AF';
                resTroughRetention.textContent = troughPercent + '% Remaining (Trough Drop)';
                resTroughRetention.style.color = currentHalfLife <= 5.0 ? '#EF4444' : '#F59E0B';
                resPeakTrough.textContent = peakTroughRatio + 'x Fluctuation';
                resHungerStatus.textContent = currentHalfLife <= 5.0 ? 'Day 6–7 Food Noise Common' : 'Moderate Appetite Drift';
                resHungerStatus.style.color = currentHalfLife <= 5.0 ? '#EF4444' : '#F59E0B';
            }

            // Update Hint
            if (targetMatcherHint) {
                if (currentInterval === 5) {
                    targetMatcherHint.textContent = 'Auto-calculates 5-day injection: e.g. 5.0 mg/wk equivalent → ' + (5.0 * (5 / 7)).toFixed(2) + ' mg every 5 days (' + Math.round(((5.0 * (5 / 7)) / currentPenStrength) * 60) + ' clicks on this pen).';
                } else {
                    targetMatcherHint.textContent = 'Auto-calculates 7-day injection: e.g. 5.0 mg/wk → 5.00 mg every 7 days (' + Math.round((5.0 / currentPenStrength) * 60) + ' clicks on this pen).';
                }
            }
        }

        // Compound Selection
        compoundBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                compoundBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentCompound = this.getAttribute('data-compound');
                currentHalfLife = parseFloat(this.getAttribute('data-halflife'));
                updateGlp1Math();
            });
        });

        // Interval Selection (5-Day vs 7-Day)
        intervalBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                intervalBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentInterval = parseInt(this.getAttribute('data-interval'), 10);
                updateGlp1Math();
            });
        });

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

        // Calculate Clicks from Target Weekly Dose
        if (calcClicksBtn && targetDoseInput) {
            calcClicksBtn.addEventListener('click', function () {
                const targetWeeklyMg = parseFloat(targetDoseInput.value);
                if (isNaN(targetWeeklyMg) || targetWeeklyMg <= 0) return;
                
                // If 5-day cycle: Target Injected Dose = Target Weekly * (5 / 7)
                // If 7-day cycle: Target Injected Dose = Target Weekly
                const targetInjectedMg = currentInterval === 5 ? (targetWeeklyMg * (5 / 7)) : targetWeeklyMg;
                
                // Formula: Required Clicks = (TargetInjected / Strength) * 60
                const calculatedClicks = Math.min(60, Math.max(1, Math.round((targetInjectedMg / currentPenStrength) * 60)));
                currentClicks = calculatedClicks;
                if (clickSlider) clickSlider.value = calculatedClicks;
                updateGlp1Math();
            });
        }

        // Initial Run
        updateGlp1Math();
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
        const targetSlider = document.getElementById('target-slider');
        const targetDisplay = document.getElementById('target-val-display');

        // Result DOM Elements
        const resConcentration = document.getElementById('res-concentration');
        const resSyringeUnits = document.getElementById('res-syringe-units');
        const resDoseVolume = document.getElementById('res-dose-volume');
        const resDosesPerVial = document.getElementById('res-doses-per-vial');
        const syringeFill = document.getElementById('syringe-fill');
        const syringeLabel = document.getElementById('syringe-label');

        function updatePeptideMath() {
            // Concentration = (Vial mg * 1000) / Bac mL  [mcg/mL]
            const concMcgPerMl = (currentVialMg * 1000) / currentBacMl;
            const concMgPerMl = (currentVialMg / currentBacMl).toFixed(2);

            // Syringe Units on 100-Unit (1.0 mL) U-100 Syringe:
            // Units = (Target mcg / Concentration mcg/mL) * 100
            const volumeMl = currentTargetMcg / concMcgPerMl;
            const units = (volumeMl * 100).toFixed(1);
            const totalDoses = Math.floor((currentVialMg * 1000) / currentTargetMcg);

            // Visual Syringe Fill (Max 100 Units = 100% width)
            const fillPercent = Math.min(100, Math.max(0, (units / 100) * 100));

            bacDisplay.textContent = currentBacMl.toFixed(1) + ' mL';
            targetDisplay.textContent = currentTargetMcg + ' mcg (' + (currentTargetMcg / 1000).toFixed(2) + ' mg)';

            resConcentration.textContent = concMgPerMl + ' mg/mL (' + Math.round(concMcgPerMl) + ' mcg/mL)';
            resSyringeUnits.textContent = units + ' Units';
            resDoseVolume.textContent = volumeMl.toFixed(3) + ' mL';
            resDosesPerVial.textContent = totalDoses + ' doses per vial';

            if (syringeFill) {
                syringeFill.style.width = fillPercent + '%';
            }
            if (syringeLabel) {
                syringeLabel.textContent = units + ' Units (' + volumeMl.toFixed(2) + ' mL)';
            }
        }

        // Vial Selection
        vialBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                vialBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentVialMg = parseFloat(this.getAttribute('data-vial'));
                updatePeptideMath();
            });
        });

        // Bac Water Slider
        if (bacSlider) {
            bacSlider.addEventListener('input', function () {
                currentBacMl = parseFloat(this.value);
                updatePeptideMath();
            });
        }

        // Target Dose Slider
        if (targetSlider) {
            targetSlider.addEventListener('input', function () {
                currentTargetMcg = parseFloat(this.value);
                updatePeptideMath();
            });
        }

        // Initial Run
        updatePeptideMath();
    }
});
