<!DOCTYPE html>
<!--
Copyright 2012 Mozilla Foundation

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

Adobe CMap resources are covered by their own copyright but the same license:

    Copyright 1990-2015 Adobe Systems Incorporated.

See https://github.com/adobe-type-tools/cmap-resources
-->
<html dir="ltr" mozdisallowselectionprint>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="google" content="notranslate">
    <title>PDF.js viewer</title>

    <!-- This snippet is used in production (included from viewer.html) -->
    <link rel="resource" type="application/l10n" href="locale/locale.json">
    <script src="../build/pdf.js" type="module"></script>

    <link rel="stylesheet" href="viewer.css">

    <script src="viewer.js" type="module"></script>
</head>

  <body tabindex="0">
    <span id="viewer-alert" class="visuallyHidden" role="alert"></span>
<div id="outerContainer">

    <div id="sidebarContainer">
        <div id="toolbarSidebar" class="toolbarHorizontalGroup">
            <div id="toolbarSidebarLeft">
            <div id="sidebarViewButtons" class="toolbarHorizontalGroup toggled" role="radiogroup">
              <button id="viewThumbnail" class="toolbarButton toggled" type="button" tabindex="0" data-l10n-id="pdfjs-thumbs-button" role="radio" aria-checked="true" aria-controls="thumbnailView">
                 <span data-l10n-id="pdfjs-thumbs-button-label"></span>
                    </button>
              <button id="viewOutline" class="toolbarButton" type="button" tabindex="0" data-l10n-id="pdfjs-document-outline-button" role="radio" aria-checked="false" aria-controls="outlineView">
                 <span data-l10n-id="pdfjs-document-outline-button-label"></span>
                    </button>
              <button id="viewAttachments" class="toolbarButton" type="button" tabindex="0" data-l10n-id="pdfjs-attachments-button" role="radio" aria-checked="false" aria-controls="attachmentsView">
                 <span data-l10n-id="pdfjs-attachments-button-label"></span>
                    </button>
              <button id="viewLayers" class="toolbarButton" type="button" tabindex="0" data-l10n-id="pdfjs-layers-button" role="radio" aria-checked="false" aria-controls="layersView">
                 <span data-l10n-id="pdfjs-layers-button-label"></span>
                    </button>
                </div>
            </div>

            <div id="toolbarSidebarRight">
            <div id="outlineOptionsContainer" class="toolbarHorizontalGroup">
                    <div class="verticalToolbarSeparator"></div>

              <button id="currentOutlineItem" class="toolbarButton" type="button" disabled="disabled" tabindex="0" data-l10n-id="pdfjs-current-outline-item-button">
                <span data-l10n-id="pdfjs-current-outline-item-button-label"></span>
                    </button>
                </div>
            </div>
        </div>
        <div id="sidebarContent">
            <div id="thumbnailView">
            </div>
            <div id="outlineView" class="hidden">
            </div>
            <div id="attachmentsView" class="hidden">
            </div>
            <div id="layersView" class="hidden">
            </div>
        </div>
        <div id="sidebarResizer"></div>
    </div>  <!-- sidebarContainer -->

    <div id="mainContainer">
        <div class="toolbar">
          <div id="toolbarContainer">
            <div id="toolbarViewer" class="toolbarHorizontalGroup">
              <div id="toolbarViewerLeft" class="toolbarHorizontalGroup">
                <button id="sidebarToggleButton" class="toolbarButton" type="button" tabindex="0" data-l10n-id="pdfjs-toggle-sidebar-button" aria-expanded="false" aria-haspopup="true" aria-controls="sidebarContainer">
                  <span data-l10n-id="pdfjs-toggle-sidebar-button-label"></span>
                </button>
                <div class="toolbarButtonSpacer"></div>
                <div class="toolbarButtonWithContainer">
                  <button id="viewFindButton" class="toolbarButton" type="button" tabindex="0" data-l10n-id="pdfjs-findbar-button" aria-expanded="false" aria-controls="findbar" <?php if (isset($_GET["sButton"]) && $_GET["sButton"]!=="true") { echo 'style="display:none;"'; }?>>
                    <span data-l10n-id="pdfjs-findbar-button-label"></span>
                  </button>
                  <div class="hidden doorHanger toolbarHorizontalGroup" id="findbar">
                    <div id="findInputContainer" class="toolbarHorizontalGroup">
                      <span class="loadingInput end toolbarHorizontalGroup">
                        <input id="findInput" class="toolbarField" tabindex="0" data-l10n-id="pdfjs-find-input" aria-invalid="false">
            </span>
                      <div class="toolbarHorizontalGroup">
                        <button id="findPreviousButton" class="toolbarButton" type="button" tabindex="0" data-l10n-id="pdfjs-find-previous-button">
                          <span data-l10n-id="pdfjs-find-previous-button-label"></span>
                    </button>
                    <div class="splitToolbarButtonSeparator"></div>
                        <button id="findNextButton" class="toolbarButton" type="button" tabindex="0" data-l10n-id="pdfjs-find-next-button">
                          <span data-l10n-id="pdfjs-find-next-button-label"></span>
                    </button>
                </div>
            </div>

                    <div id="findbarOptionsOneContainer" class="toolbarHorizontalGroup">
                      <div class="toggleButton toolbarLabel">
                        <input type="checkbox" id="findHighlightAll" tabindex="0" />
                        <label for="findHighlightAll" data-l10n-id="pdfjs-find-highlight-checkbox"></label>
                      </div>
                      <div class="toggleButton toolbarLabel">
                        <input type="checkbox" id="findMatchCase" tabindex="0" />
                        <label for="findMatchCase" data-l10n-id="pdfjs-find-match-case-checkbox-label"></label>
            </div>
                    </div>
                    <div id="findbarOptionsTwoContainer" class="toolbarHorizontalGroup">
                      <div class="toggleButton toolbarLabel">
                        <input type="checkbox" id="findMatchDiacritics" tabindex="0" />
                        <label for="findMatchDiacritics" data-l10n-id="pdfjs-find-match-diacritics-checkbox-label"></label>
                      </div>
                      <div class="toggleButton toolbarLabel">
                        <input type="checkbox" id="findEntireWord" tabindex="0" />
                        <label for="findEntireWord" data-l10n-id="pdfjs-find-entire-word-checkbox-label"></label>
                      </div>
            </div>

                    <div id="findbarMessageContainer" class="toolbarHorizontalGroup" aria-live="polite">
                <span id="findResultsCount" class="toolbarLabel"></span>
                <span id="findMsg" class="toolbarLabel"></span>
            </div>
        </div>  <!-- findbar -->
                </div>
                <div class="toolbarHorizontalGroup hiddenSmallView">
                  <button class="toolbarButton" type="button" id="previous" tabindex="0" data-l10n-id="pdfjs-previous-button">
                    <span data-l10n-id="pdfjs-previous-button-label"></span>
                  </button>
                  <div class="splitToolbarButtonSeparator"></div>
                  <button class="toolbarButton" type="button" id="next" tabindex="0" data-l10n-id="pdfjs-next-button">
                    <span data-l10n-id="pdfjs-next-button-label"></span>
                  </button>
                </div>
                <div class="toolbarHorizontalGroup">
                  <span class="loadingInput start toolbarHorizontalGroup">
                    <input type="number" id="pageNumber" class="toolbarField" value="1" min="1" tabindex="0" data-l10n-id="pdfjs-page-input" autocomplete="off">
                  </span>
                  <span id="numPages" class="toolbarLabel"></span>
                </div>
              </div>
              <div id="toolbarViewerMiddle" class="toolbarHorizontalGroup">
                <div class="toolbarHorizontalGroup">
                  <button id="zoomOutButton" class="toolbarButton" type="button" tabindex="0" data-l10n-id="pdfjs-zoom-out-button">
                    <span data-l10n-id="pdfjs-zoom-out-button-label"></span>
                  </button>
                  <div class="splitToolbarButtonSeparator"></div>
                  <button id="zoomInButton" class="toolbarButton" type="button" tabindex="0" data-l10n-id="pdfjs-zoom-in-button">
                    <span data-l10n-id="pdfjs-zoom-in-button-label"></span>
                  </button>
                </div>
                <span id="scaleSelectContainer" class="dropdownToolbarButton">
                  <select id="scaleSelect" tabindex="0" data-l10n-id="pdfjs-zoom-select">
                    <option id="pageAutoOption" value="auto" selected="selected" data-l10n-id="pdfjs-page-scale-auto"></option>
                    <option id="pageActualOption" value="page-actual" data-l10n-id="pdfjs-page-scale-actual"></option>
                    <option id="pageFitOption" value="page-fit" data-l10n-id="pdfjs-page-scale-fit"></option>
                    <option id="pageWidthOption" value="page-width" data-l10n-id="pdfjs-page-scale-width"></option>
                    <option id="customScaleOption" value="custom" disabled="disabled" hidden="true" data-l10n-id="pdfjs-page-scale-percent" data-l10n-args='{ "scale": 0 }'></option>
                    <option value="0.5" data-l10n-id="pdfjs-page-scale-percent" data-l10n-args='{ "scale": 50 }'></option>
                    <option value="0.75" data-l10n-id="pdfjs-page-scale-percent" data-l10n-args='{ "scale": 75 }'></option>
                    <option value="1" data-l10n-id="pdfjs-page-scale-percent" data-l10n-args='{ "scale": 100 }'></option>
                    <option value="1.25" data-l10n-id="pdfjs-page-scale-percent" data-l10n-args='{ "scale": 125 }'></option>
                    <option value="1.5" data-l10n-id="pdfjs-page-scale-percent" data-l10n-args='{ "scale": 150 }'></option>
                    <option value="2" data-l10n-id="pdfjs-page-scale-percent" data-l10n-args='{ "scale": 200 }'></option>
                    <option value="3" data-l10n-id="pdfjs-page-scale-percent" data-l10n-args='{ "scale": 300 }'></option>
                    <option value="4" data-l10n-id="pdfjs-page-scale-percent" data-l10n-args='{ "scale": 400 }'></option>
                  </select>
                </span>
              </div>
              <div id="toolbarViewerRight" class="toolbarHorizontalGroup">
                <div id="editorModeButtons" class="toolbarHorizontalGroup" role="radiogroup" <?php if ($_GET["editButtons"]!=="true") { echo 'style="display:none;"'; } ?>>
                  <div id="editorSignature" class="toolbarButtonWithContainer" hidden="true">
                    <button id="editorSignatureButton" class="toolbarButton" type="button" tabindex="0" disabled="disabled" role="radio" aria-expanded="false" aria-haspopup="true" aria-controls="editorSignatureParamsToolbar" data-l10n-id="pdfjs-editor-signature-button">
                      <span data-l10n-id="pdfjs-editor-signature-button-label"></span>
                    </button>
                    <div class="editorParamsToolbar hidden doorHangerRight menu" id="editorSignatureParamsToolbar">
                      <div id="addSignatureDoorHanger" class="menuContainer" role="region" data-l10n-id="pdfjs-editor-add-signature-container">
                        <button id="editorSignatureAddSignature" class="toolbarButton labeled" type="button" tabindex="0" data-l10n-id="pdfjs-editor-signature-add-signature-button">
                          <span data-l10n-id="pdfjs-editor-signature-add-signature-button-label" class="editorParamsLabel"></span>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div id="editorHighlight" class="toolbarButtonWithContainer">
                    <button id="editorHighlightButton" class="toolbarButton" type="button" disabled="disabled" role="radio" aria-expanded="false" aria-haspopup="true" aria-controls="editorHighlightParamsToolbar" tabindex="0" data-l10n-id="pdfjs-editor-highlight-button">
                      <span data-l10n-id="pdfjs-editor-highlight-button-label"></span>
                    </button>
        <div class="editorParamsToolbar hidden doorHangerRight" id="editorHighlightParamsToolbar">
            <div id="highlightParamsToolbarContainer" class="editorParamsToolbarContainer">
                <div id="editorHighlightColorPicker" class="colorPicker">
                          <span id="highlightColorPickerLabel" class="editorParamsLabel" data-l10n-id="pdfjs-editor-highlight-colorpicker-label"></span>
                </div>
                <div id="editorHighlightThickness">
                          <label for="editorFreeHighlightThickness" class="editorParamsLabel" data-l10n-id="pdfjs-editor-free-highlight-thickness-input"></label>
                    <div class="thicknessPicker">
                            <input type="range" id="editorFreeHighlightThickness" class="editorParamsSlider" data-l10n-id="pdfjs-editor-free-highlight-thickness-title" value="12" min="8" max="24" step="1" tabindex="0">
                    </div>
                </div>
                <div id="editorHighlightVisibility">
                    <div class="divider"></div>
                    <div class="toggler">
                            <label for="editorHighlightShowAll" class="editorParamsLabel" data-l10n-id="pdfjs-editor-highlight-show-all-button-label"></label>
                            <button id="editorHighlightShowAll" class="toggle-button" type="button" data-l10n-id="pdfjs-editor-highlight-show-all-button" aria-pressed="true" tabindex="0"></button>
                          </div>
                    </div>
                </div>
            </div>
        </div>
                  <div id="editorFreeText" class="toolbarButtonWithContainer">
                    <button id="editorFreeTextButton" class="toolbarButton" type="button" disabled="disabled" role="radio" aria-expanded="false" aria-haspopup="true" aria-controls="editorFreeTextParamsToolbar" tabindex="0" data-l10n-id="pdfjs-editor-free-text-button">
                      <span data-l10n-id="pdfjs-editor-free-text-button-label"></span>
                    </button>
        <div class="editorParamsToolbar hidden doorHangerRight" id="editorFreeTextParamsToolbar">
            <div class="editorParamsToolbarContainer">
                <div class="editorParamsSetter">
                          <label for="editorFreeTextColor" class="editorParamsLabel" data-l10n-id="pdfjs-editor-free-text-color-input"></label>
                          <input type="color" id="editorFreeTextColor" class="editorParamsColor" tabindex="0">
                </div>
                <div class="editorParamsSetter">
                          <label for="editorFreeTextFontSize" class="editorParamsLabel" data-l10n-id="pdfjs-editor-free-text-size-input"></label>
                          <input type="range" id="editorFreeTextFontSize" class="editorParamsSlider" value="10" min="5" max="100" step="1" tabindex="0">
                        </div>
                </div>
            </div>
        </div>
                  <div id="editorInk" class="toolbarButtonWithContainer">
                    <button id="editorInkButton" class="toolbarButton" type="button" disabled="disabled" role="radio" aria-expanded="false" aria-haspopup="true" aria-controls="editorInkParamsToolbar" tabindex="0" data-l10n-id="pdfjs-editor-ink-button">
                      <span data-l10n-id="pdfjs-editor-ink-button-label"></span>
                    </button>
        <div class="editorParamsToolbar hidden doorHangerRight" id="editorInkParamsToolbar">
            <div class="editorParamsToolbarContainer">
                <div class="editorParamsSetter">
                          <label for="editorInkColor" class="editorParamsLabel" data-l10n-id="pdfjs-editor-ink-color-input"></label>
                          <input type="color" id="editorInkColor" class="editorParamsColor" tabindex="0">
                </div>
                <div class="editorParamsSetter">
                          <label for="editorInkThickness" class="editorParamsLabel" data-l10n-id="pdfjs-editor-ink-thickness-input"></label>
                          <input type="range" id="editorInkThickness" class="editorParamsSlider" value="1" min="1" max="20" step="1" tabindex="0">
                </div>
                <div class="editorParamsSetter">
                          <label for="editorInkOpacity" class="editorParamsLabel" data-l10n-id="pdfjs-editor-ink-opacity-input"></label>
                          <input type="range" id="editorInkOpacity" class="editorParamsSlider" value="1" min="0.05" max="1" step="0.05" tabindex="0">
                        </div>
                </div>
            </div>
        </div>
                  <div id="editorStamp" class="toolbarButtonWithContainer">
                    <button id="editorStampButton" class="toolbarButton" type="button" disabled="disabled" role="radio" aria-expanded="false" aria-haspopup="true" aria-controls="editorStampParamsToolbar" tabindex="0" data-l10n-id="pdfjs-editor-stamp-button">
                      <span data-l10n-id="pdfjs-editor-stamp-button-label"></span>
                    </button>
                    <div class="editorParamsToolbar hidden doorHangerRight menu" id="editorStampParamsToolbar">
                      <div class="menuContainer">
                        <button id="editorStampAddImage" class="toolbarButton labeled" type="button" tabindex="0" data-l10n-id="pdfjs-editor-stamp-add-image-button">
                          <span class="editorParamsLabel" data-l10n-id="pdfjs-editor-stamp-add-image-button-label"></span>
                </button>
            </div>
        </div>
                  </div>
                </div>

                <div id="editorModeSeparator" class="verticalToolbarSeparator"></div>

                <div class="toolbarHorizontalGroup hiddenMediumView">
                  <button id="printButton" class="toolbarButton" type="button" tabindex="0" data-l10n-id="pdfjs-print-button" <?php if (isset($_GET["pButton"]) && $_GET["pButton"]!=="true") { echo 'style="display:none;"'; }?>>
                    <span data-l10n-id="pdfjs-print-button-label"></span>
                  </button>

                  <button id="downloadButton" class="toolbarButton" type="button" tabindex="0" data-l10n-id="pdfjs-save-button" <?php if (isset($_GET["dButton"]) && $_GET["dButton"]!=="true") { echo 'style="display:none;"'; }?>>
                    <span data-l10n-id="pdfjs-save-button-label"></span>
                </button>
                </div>

                <div class="verticalToolbarSeparator hiddenMediumView"></div>

                <div id="secondaryToolbarToggle" class="toolbarButtonWithContainer">
                  <button id="secondaryToolbarToggleButton" class="toolbarButton" type="button" tabindex="0" data-l10n-id="pdfjs-tools-button" aria-expanded="false" aria-haspopup="true" aria-controls="secondaryToolbar">
                    <span data-l10n-id="pdfjs-tools-button-label"></span>
                  </button>
                  <div id="secondaryToolbar" class="hidden doorHangerRight menu">
                    <div id="secondaryToolbarButtonContainer" class="menuContainer">
                      <button id="secondaryOpenFile" class="toolbarButton labeled" type="button" tabindex="0" data-l10n-id="pdfjs-open-file-button" <?php if (isset($_GET["oButton"]) && $_GET["oButton"]!=="true") { echo 'style="display:none;"'; } ?>>
                        <span data-l10n-id="pdfjs-open-file-button-label"></span>
                      </button>

                      <div class="visibleMediumView">
                        <button id="secondaryPrint" class="toolbarButton labeled" type="button" tabindex="0" data-l10n-id="pdfjs-print-button" <?php if (isset($_GET["pButton"]) && $_GET["pButton"]!=="true") { echo 'style="display:none;"'; } ?>>
                          <span data-l10n-id="pdfjs-print-button-label"></span>
                </button>

                        <button id="secondaryDownload" class="toolbarButton labeled" type="button" tabindex="0" data-l10n-id="pdfjs-save-button" <?php if (isset($_GET["dButton"]) && $_GET["dButton"]!=="true") { echo 'style="display:none;"'; } ?>>
                          <span data-l10n-id="pdfjs-save-button-label"></span>
                </button>

                      </div>

                <div class="horizontalToolbarSeparator"></div>

                      <button id="presentationMode" class="toolbarButton labeled" type="button" tabindex="0" data-l10n-id="pdfjs-presentation-mode-button">
                        <span data-l10n-id="pdfjs-presentation-mode-button-label"></span>
                </button>

                      <a href="#" id="viewBookmark" class="toolbarButton labeled" tabindex="0" data-l10n-id="pdfjs-bookmark-button">
                        <span data-l10n-id="pdfjs-bookmark-button-label"></span>
                </a>

                <div id="viewBookmarkSeparator" class="horizontalToolbarSeparator"></div>

                      <button id="firstPage" class="toolbarButton labeled" type="button" tabindex="0" data-l10n-id="pdfjs-first-page-button">
                        <span data-l10n-id="pdfjs-first-page-button-label"></span>
                </button>
                      <button id="lastPage" class="toolbarButton labeled" type="button" tabindex="0" data-l10n-id="pdfjs-last-page-button">
                        <span data-l10n-id="pdfjs-last-page-button-label"></span>
                </button>

                <div class="horizontalToolbarSeparator"></div>

                      <button id="pageRotateCw" class="toolbarButton labeled" type="button" tabindex="0" data-l10n-id="pdfjs-page-rotate-cw-button">
                        <span data-l10n-id="pdfjs-page-rotate-cw-button-label"></span>
                </button>
                      <button id="pageRotateCcw" class="toolbarButton labeled" type="button" tabindex="0" data-l10n-id="pdfjs-page-rotate-ccw-button">
                        <span data-l10n-id="pdfjs-page-rotate-ccw-button-label"></span>
                </button>

                <div class="horizontalToolbarSeparator"></div>

                <div id="cursorToolButtons" role="radiogroup">
                        <button id="cursorSelectTool" class="toolbarButton labeled toggled" type="button" tabindex="0" data-l10n-id="pdfjs-cursor-text-select-tool-button" role="radio" aria-checked="true">
                          <span data-l10n-id="pdfjs-cursor-text-select-tool-button-label"></span>
                    </button>
                        <button id="cursorHandTool" class="toolbarButton labeled" type="button" tabindex="0" data-l10n-id="pdfjs-cursor-hand-tool-button" role="radio" aria-checked="false">
                          <span data-l10n-id="pdfjs-cursor-hand-tool-button-label"></span>
                    </button>
                </div>

                <div class="horizontalToolbarSeparator"></div>

                <div id="scrollModeButtons" role="radiogroup">
                        <button id="scrollPage" class="toolbarButton labeled" type="button" tabindex="0" data-l10n-id="pdfjs-scroll-page-button" role="radio" aria-checked="false">
                          <span data-l10n-id="pdfjs-scroll-page-button-label"></span>
                    </button>
                        <button id="scrollVertical" class="toolbarButton labeled toggled" type="button" tabindex="0" data-l10n-id="pdfjs-scroll-vertical-button" role="radio" aria-checked="true">
                          <span data-l10n-id="pdfjs-scroll-vertical-button-label"></span>
                    </button>
                        <button id="scrollHorizontal" class="toolbarButton labeled" type="button" tabindex="0" data-l10n-id="pdfjs-scroll-horizontal-button" role="radio" aria-checked="false">
                          <span data-l10n-id="pdfjs-scroll-horizontal-button-label"></span>
                    </button>
                        <button id="scrollWrapped" class="toolbarButton labeled" type="button" tabindex="0" data-l10n-id="pdfjs-scroll-wrapped-button" role="radio" aria-checked="false">
                          <span data-l10n-id="pdfjs-scroll-wrapped-button-label"></span>
                    </button>
                </div>

                <div class="horizontalToolbarSeparator"></div>

                <div id="spreadModeButtons" role="radiogroup">
                        <button id="spreadNone" class="toolbarButton labeled toggled" type="button" tabindex="0" data-l10n-id="pdfjs-spread-none-button" role="radio" aria-checked="true">
                          <span data-l10n-id="pdfjs-spread-none-button-label"></span>
                    </button>
                        <button id="spreadOdd" class="toolbarButton labeled" type="button" tabindex="0" data-l10n-id="pdfjs-spread-odd-button" role="radio" aria-checked="false">
                          <span data-l10n-id="pdfjs-spread-odd-button-label"></span>
                    </button>
                        <button id="spreadEven" class="toolbarButton labeled" type="button" tabindex="0" data-l10n-id="pdfjs-spread-even-button" role="radio" aria-checked="false">
                          <span data-l10n-id="pdfjs-spread-even-button-label"></span>
                    </button>
                </div>

                      <div id="imageAltTextSettingsSeparator" class="horizontalToolbarSeparator hidden"></div>
                      <button id="imageAltTextSettings" type="button" class="toolbarButton labeled hidden" tabindex="0" data-l10n-id="pdfjs-image-alt-text-settings-button" aria-controls="altTextSettingsDialog">
                        <span data-l10n-id="pdfjs-image-alt-text-settings-button-label"></span>
                      </button>

                <div class="horizontalToolbarSeparator"></div>

                      <button id="documentProperties" class="toolbarButton labeled" type="button" tabindex="0" data-l10n-id="pdfjs-document-properties-button" aria-controls="documentPropertiesDialog">
                        <span data-l10n-id="pdfjs-document-properties-button-label"></span>
                </button>
            </div>
        </div>  <!-- secondaryToolbar -->
                        </div>
                    </div>
                </div>
                <div id="loadingBar">
                    <div class="progress">
                        <div class="glimmer">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="viewerContainer" tabindex="0">
            <div id="viewer" class="pdfViewer"></div>
        </div>
    </div> <!-- mainContainer -->

    <div id="dialogContainer">
        <dialog id="passwordDialog">
            <div class="row">
            <label for="password" id="passwordText" data-l10n-id="pdfjs-password-label"></label>
            </div>
            <div class="row">
                <input type="password" id="password" class="toolbarField">
            </div>
            <div class="buttonRow">
            <button id="passwordCancel" class="dialogButton" type="button"><span data-l10n-id="pdfjs-password-cancel-button"></span></button>
            <button id="passwordSubmit" class="dialogButton" type="button"><span data-l10n-id="pdfjs-password-ok-button"></span></button>
            </div>
        </dialog>
        <dialog id="documentPropertiesDialog">
            <div class="row">
            <span id="fileNameLabel" data-l10n-id="pdfjs-document-properties-file-name"></span>
                <p id="fileNameField" aria-labelledby="fileNameLabel">-</p>
            </div>
            <div class="row">
            <span id="fileSizeLabel" data-l10n-id="pdfjs-document-properties-file-size"></span>
                <p id="fileSizeField" aria-labelledby="fileSizeLabel">-</p>
            </div>
            <div class="separator"></div>
            <div class="row">
            <span id="titleLabel" data-l10n-id="pdfjs-document-properties-title"></span>
                <p id="titleField" aria-labelledby="titleLabel">-</p>
            </div>
            <div class="row">
            <span id="authorLabel" data-l10n-id="pdfjs-document-properties-author"></span>
                <p id="authorField" aria-labelledby="authorLabel">-</p>
            </div>
            <div class="row">
            <span id="subjectLabel" data-l10n-id="pdfjs-document-properties-subject"></span>
                <p id="subjectField" aria-labelledby="subjectLabel">-</p>
            </div>
            <div class="row">
            <span id="keywordsLabel" data-l10n-id="pdfjs-document-properties-keywords"></span>
                <p id="keywordsField" aria-labelledby="keywordsLabel">-</p>
            </div>
            <div class="row">
            <span id="creationDateLabel" data-l10n-id="pdfjs-document-properties-creation-date"></span>
                <p id="creationDateField" aria-labelledby="creationDateLabel">-</p>
            </div>
            <div class="row">
            <span id="modificationDateLabel" data-l10n-id="pdfjs-document-properties-modification-date"></span>
                <p id="modificationDateField" aria-labelledby="modificationDateLabel">-</p>
            </div>
            <div class="row">
            <span id="creatorLabel" data-l10n-id="pdfjs-document-properties-creator"></span>
                <p id="creatorField" aria-labelledby="creatorLabel">-</p>
            </div>
            <div class="separator"></div>
            <div class="row">
            <span id="producerLabel" data-l10n-id="pdfjs-document-properties-producer"></span>
                <p id="producerField" aria-labelledby="producerLabel">-</p>
            </div>
            <div class="row">
            <span id="versionLabel" data-l10n-id="pdfjs-document-properties-version"></span>
                <p id="versionField" aria-labelledby="versionLabel">-</p>
            </div>
            <div class="row">
            <span id="pageCountLabel" data-l10n-id="pdfjs-document-properties-page-count"></span>
                <p id="pageCountField" aria-labelledby="pageCountLabel">-</p>
            </div>
            <div class="row">
            <span id="pageSizeLabel" data-l10n-id="pdfjs-document-properties-page-size"></span>
                <p id="pageSizeField" aria-labelledby="pageSizeLabel">-</p>
            </div>
            <div class="separator"></div>
            <div class="row">
            <span id="linearizedLabel" data-l10n-id="pdfjs-document-properties-linearized"></span>
                <p id="linearizedField" aria-labelledby="linearizedLabel">-</p>
            </div>
            <div class="buttonRow">
            <button id="documentPropertiesClose" class="dialogButton" type="button"><span data-l10n-id="pdfjs-document-properties-close-button"></span></button>
            </div>
        </dialog>
        <dialog class="dialog altText" id="altTextDialog" aria-labelledby="dialogLabel" aria-describedby="dialogDescription">
            <div id="altTextContainer" class="mainContainer">
                <div id="overallDescription">
              <span id="dialogLabel" data-l10n-id="pdfjs-editor-alt-text-dialog-label" class="title"></span>
              <span id="dialogDescription" data-l10n-id="pdfjs-editor-alt-text-dialog-description"></span>
                </div>
                <div id="addDescription">
                    <div class="radio">
                        <div class="radioButton">
                            <input type="radio" id="descriptionButton" name="altTextOption" tabindex="0" aria-describedby="descriptionAreaLabel" checked>
                  <label for="descriptionButton" data-l10n-id="pdfjs-editor-alt-text-add-description-label"></label>
                        </div>
                        <div class="radioLabel">
                  <span id="descriptionAreaLabel" data-l10n-id="pdfjs-editor-alt-text-add-description-description"></span>
                        </div>
                    </div>
                    <div class="descriptionArea">
                <textarea id="descriptionTextarea" aria-labelledby="descriptionAreaLabel" data-l10n-id="pdfjs-editor-alt-text-textarea" tabindex="0"></textarea>
                    </div>
                </div>
                <div id="markAsDecorative">
                    <div class="radio">
                        <div class="radioButton">
                            <input type="radio" id="decorativeButton" name="altTextOption" aria-describedby="decorativeLabel">
                  <label for="decorativeButton" data-l10n-id="pdfjs-editor-alt-text-mark-decorative-label"></label>
                        </div>
                        <div class="radioLabel">
                  <span id="decorativeLabel" data-l10n-id="pdfjs-editor-alt-text-mark-decorative-description"></span>
                </div>
              </div>
            </div>
            <div id="buttons">
              <button id="altTextCancel" class="secondaryButton" type="button" tabindex="0"><span data-l10n-id="pdfjs-editor-alt-text-cancel-button"></span></button>
              <button id="altTextSave" class="primaryButton" type="button" tabindex="0"><span data-l10n-id="pdfjs-editor-alt-text-save-button"></span></button>
            </div>
          </div>
        </dialog>
        <dialog class="dialog newAltText" id="newAltTextDialog" aria-labelledby="newAltTextTitle" aria-describedby="newAltTextDescription" tabindex="0">
          <div id="newAltTextContainer" class="mainContainer">
            <div class="title">
              <span id="newAltTextTitle" data-l10n-id="pdfjs-editor-new-alt-text-dialog-edit-label" role="sectionhead" tabindex="0"></span>
            </div>
            <div id="mainContent">
              <div id="descriptionAndSettings">
                <div id="descriptionInstruction">
                  <div id="newAltTextDescriptionContainer">
                    <div class="altTextSpinner" role="status" aria-live="polite"></div>
                    <textarea id="newAltTextDescriptionTextarea" aria-labelledby="descriptionAreaLabel" data-l10n-id="pdfjs-editor-new-alt-text-textarea" tabindex="0"></textarea>
                  </div>
                  <span id="newAltTextDescription" role="note" data-l10n-id="pdfjs-editor-new-alt-text-description"></span>
                  <div id="newAltTextDisclaimer" role="note"><div><span data-l10n-id="pdfjs-editor-new-alt-text-disclaimer1"></span> <a href="https://support.mozilla.org/en-US/kb/pdf-alt-text" target="_blank" rel="noopener noreferrer" id="newAltTextLearnMore" data-l10n-id="pdfjs-editor-new-alt-text-disclaimer-learn-more-url" tabindex="0"></a></div></div>
                </div>
                <div id="newAltTextCreateAutomatically" class="toggler">
                  <button id="newAltTextCreateAutomaticallyButton" class="toggle-button" type="button" aria-pressed="true" tabindex="0"></button>
                  <label for="newAltTextCreateAutomaticallyButton" class="togglerLabel" data-l10n-id="pdfjs-editor-new-alt-text-create-automatically-button-label"></label>
                </div>
                <div id="newAltTextDownloadModel" class="hidden">
                  <span id="newAltTextDownloadModelDescription" data-l10n-id="pdfjs-editor-new-alt-text-ai-model-downloading-progress" aria-valuemin="0" data-l10n-args='{ "totalSize": 0, "downloadedSize": 0 }'></span>
                </div>
              </div>
              <div id="newAltTextImagePreview"></div>
            </div>
            <div id="newAltTextError" class="messageBar">
              <div>
                <div>
                  <span class="title" data-l10n-id="pdfjs-editor-new-alt-text-error-title"></span>
                  <span  class="description" data-l10n-id="pdfjs-editor-new-alt-text-error-description"></span>
                </div>
                <button id="newAltTextCloseButton" class="closeButton" type="button" tabindex="0"><span data-l10n-id="pdfjs-editor-new-alt-text-error-close-button"></span></button>
              </div>
            </div>
            <div id="newAltTextButtons" class="dialogButtonsGroup">
              <button id="newAltTextCancel" type="button" class="secondaryButton hidden" tabindex="0"><span data-l10n-id="pdfjs-editor-alt-text-cancel-button"></span></button>
              <button id="newAltTextNotNow" type="button" class="secondaryButton" tabindex="0"><span data-l10n-id="pdfjs-editor-new-alt-text-not-now-button"></span></button>
              <button id="newAltTextSave" type="button" class="primaryButton" tabindex="0"><span data-l10n-id="pdfjs-editor-alt-text-save-button"></span></button>
            </div>
          </div>
        </dialog>

        <dialog class="dialog" id="altTextSettingsDialog" aria-labelledby="altTextSettingsTitle">
          <div id="altTextSettingsContainer" class="mainContainer">
            <div class="title">
              <span id="altTextSettingsTitle" data-l10n-id="pdfjs-editor-alt-text-settings-dialog-label" role="sectionhead" tabindex="0" class="title"></span>
            </div>
            <div id="automaticAltText">
              <span data-l10n-id="pdfjs-editor-alt-text-settings-automatic-title"></span>
              <div id="automaticSettings">
                <div id="createModelSetting">
                  <div class="toggler">
                    <button id="createModelButton" type="button" class="toggle-button" aria-pressed="true" tabindex="0"></button>
                    <label for="createModelButton" class="togglerLabel" data-l10n-id="pdfjs-editor-alt-text-settings-create-model-button-label"></label>
                  </div>
                  <div id="createModelDescription" class="description">
                    <span data-l10n-id="pdfjs-editor-alt-text-settings-create-model-description"></span> <a href="https://support.mozilla.org/en-US/kb/pdf-alt-text" target="_blank" rel="noopener noreferrer" id="altTextSettingsLearnMore" data-l10n-id="pdfjs-editor-new-alt-text-disclaimer-learn-more-url" tabindex="0"></a>
                  </div>
                </div>
                <div id="aiModelSettings">
                  <div>
                    <span data-l10n-id="pdfjs-editor-alt-text-settings-download-model-label" data-l10n-args='{ "totalSize": 180 }'></span>
                    <div id="aiModelDescription" class="description">
                      <span data-l10n-id="pdfjs-editor-alt-text-settings-ai-model-description"></span>
                    </div>
                  </div>
                  <button id="deleteModelButton" type="button" class="secondaryButton" tabindex="0"><span data-l10n-id="pdfjs-editor-alt-text-settings-delete-model-button"></span></button>
                  <button id="downloadModelButton" type="button" class="secondaryButton" tabindex="0"><span data-l10n-id="pdfjs-editor-alt-text-settings-download-model-button"></span></button>
                </div>
              </div>
            </div>
            <div class="dialogSeparator"></div>
            <div id="altTextEditor">
              <span data-l10n-id="pdfjs-editor-alt-text-settings-editor-title"></span>
              <div id="showAltTextEditor">
                <div class="toggler">
                  <button id="showAltTextDialogButton" type="button" class="toggle-button" aria-pressed="true" tabindex="0"></button>
                  <label for="showAltTextDialogButton" class="togglerLabel" data-l10n-id="pdfjs-editor-alt-text-settings-show-dialog-button-label"></label>
                </div>
                <div id="showAltTextDialogDescription" class="description">
                  <span data-l10n-id="pdfjs-editor-alt-text-settings-show-dialog-description"></span>
                </div>
              </div>
            </div>
            <div id="buttons" class="dialogButtonsGroup">
              <button id="altTextSettingsCloseButton" type="button" class="primaryButton" tabindex="0"><span data-l10n-id="pdfjs-editor-alt-text-settings-close-button"></span></button>
            </div>
          </div>
        </dialog>

        <dialog class="dialog signatureDialog" id="addSignatureDialog" aria-labelledby="addSignatureDialogLabel">
          <span id="addSignatureDialogLabel" data-l10n-id="pdfjs-editor-add-signature-dialog-label"></span>
          <div id="addSignatureContainer" class="mainContainer">
            <div class="title">
              <span role="sectionhead" data-l10n-id="pdfjs-editor-add-signature-dialog-title" tabindex="0"></span>
            </div>
            <div role="tablist" id="addSignatureOptions">
              <button id="addSignatureTypeButton" type="button" role="tab" aria-selected="true" aria-controls="addSignatureTypeContainer" data-l10n-id="pdfjs-editor-add-signature-type-button" tabindex="0"></button>
              <button id="addSignatureDrawButton" type="button" role="tab" aria-selected="false" aria-controls="addSignatureDrawContainer" data-l10n-id="pdfjs-editor-add-signature-draw-button" tabindex="0"></button>
              <button id="addSignatureImageButton" type="button" role="tab" aria-selected="false" aria-controls="addSignatureImageContainer" data-l10n-id="pdfjs-editor-add-signature-image-button" tabindex="-1"></button>
            </div>
            <div id="addSignatureActionContainer" data-selected="type">
              <div id="addSignatureTypeContainer" role="tabpanel" aria-labelledby="addSignatureTypeContainer">
                <input id="addSignatureTypeInput" type="text" data-l10n-id="pdfjs-editor-add-signature-type-input" tabindex="0"></input>
              </div>
              <div id="addSignatureDrawContainer" role="tabpanel" aria-labelledby="addSignatureDrawButton" tabindex="-1">
                <svg id="addSignatureDraw" xmlns="http://www.w3.org/2000/svg" aria-labelledby="addSignatureDrawPlaceholder"></svg>
                <span id="addSignatureDrawPlaceholder" data-l10n-id="pdfjs-editor-add-signature-draw-placeholder"></span>
                <div id="thickness">
                  <div>
                    <label for="addSignatureDrawThickness" data-l10n-id="pdfjs-editor-add-signature-draw-thickness-range-label"></label>
                    <input type="range" id="addSignatureDrawThickness" min="1" max="5" step="1" value="1" data-l10n-id="pdfjs-editor-add-signature-draw-thickness-range" data-l10n-args='{ "thickness": 1 }' tabindex="0">
                  </div>
                </div>
              </div>
              <div id="addSignatureImageContainer" role="tabpanel" aria-labelledby="addSignatureImageButton" tabindex="-1">
                <svg id="addSignatureImage" xmlns="http://www.w3.org/2000/svg" aria-labelledby="addSignatureImagePlaceholder"></svg>
                <div id="addSignatureImagePlaceholder">
                  <span data-l10n-id="pdfjs-editor-add-signature-image-placeholder"></span>
                  <label id="addSignatureImageBrowse" for="addSignatureFilePicker" tabindex="0">
                    <a data-l10n-id="pdfjs-editor-add-signature-image-browse-link"></a>
                  </label>
                  <input id="addSignatureFilePicker" type="file"></input>
                </div>
              </div>
              <div id="addSignatureControls">
                <div id="horizontalContainer">
                  <div id="addSignatureDescriptionContainer">
                    <label for="addSignatureDescInput" data-l10n-id="pdfjs-editor-add-signature-description-label"></label>
                    <span id="addSignatureDescription" class="inputWithClearButton">
                      <input id="addSignatureDescInput" type="text" data-l10n-id="pdfjs-editor-add-signature-description-input" tabindex="0"></input>
                      <button class="clearInputButton" type="button" tabindex="0" aria-hidden="true"></button>
                  </span>
                        </div>
                  <button id="clearSignatureButton" type="button" data-l10n-id="pdfjs-editor-add-signature-clear-button" tabindex="0"><span data-l10n-id="pdfjs-editor-add-signature-clear-button-label"></span></button>
                </div>
                <div id="addSignatureSaveContainer">
                  <input type="checkbox" id="addSignatureSaveCheckbox"></input>
                  <label for="addSignatureSaveCheckbox" data-l10n-id="pdfjs-editor-add-signature-save-checkbox"></label>
                  <span></span>
                  <span id="addSignatureSaveWarning" data-l10n-id="pdfjs-editor-add-signature-save-warning-message"></span>
                </div>
              </div>
              <div id="addSignatureError" hidden="true" class="messageBar">
                <div>
                  <div>
                    <span class="title" data-l10n-id="pdfjs-editor-add-signature-image-upload-error-title"></span>
                    <span class="description" data-l10n-id="pdfjs-editor-add-signature-image-upload-error-description"></span>
                  </div>
                  <button id="addSignatureErrorCloseButton" class="closeButton" type="button" tabindex="0"><span data-l10n-id="pdfjs-editor-add-signature-error-close-button"></span></button>
                </div>
              </div>
              <div class="dialogButtonsGroup">
                <button id="addSignatureCancelButton" type="button" class="secondaryButton" tabindex="0"><span data-l10n-id="pdfjs-editor-add-signature-cancel-button"></span></button>
                <button id="addSignatureAddButton" type="button" class="primaryButton" disabled tabindex="0"><span data-l10n-id="pdfjs-editor-add-signature-add-button"></span></button>
              </div>
            </div>
          </div>
       </dialog>

       <dialog class="dialog signatureDialog" id="editSignatureDescriptionDialog" aria-labelledby="editSignatureDescriptionTitle">
        <div id="editSignatureDescriptionContainer" class="mainContainer">
          <div class="title">
            <span id="editSignatureDescriptionTitle" role="sectionhead" data-l10n-id="pdfjs-editor-edit-signature-dialog-title" tabindex="0"></span>
          </div>
          <div id="editSignatureDescriptionAndView">
            <div id="editSignatureDescriptionContainer">
              <label for="editSignatureDescInput" data-l10n-id="pdfjs-editor-add-signature-description-label"></label>
              <span id="editSignatureDescription" class="inputWithClearButton">
                <input id="editSignatureDescInput" type="text" data-l10n-id="pdfjs-editor-add-signature-description-input" tabindex="0"></input>
                <button class="clearInputButton" type="button" tabindex="0" aria-hidden="true"></button>
              </span>
                    </div>
            <svg id="editSignatureView" xmlns="http://www.w3.org/2000/svg"></svg>
                </div>
          <div class="dialogButtonsGroup">
            <button id="editSignatureCancelButton" type="button" class="secondaryButton" tabindex="0"><span data-l10n-id="pdfjs-editor-add-signature-cancel-button"></span></button>
            <button id="editSignatureUpdateButton" type="button" class="primaryButton" disabled tabindex="0"><span data-l10n-id="pdfjs-editor-edit-signature-update-button"></span></button>
                </div>
            </div>
        </dialog>

        <dialog id="printServiceDialog" style="min-width: 200px;">
            <div class="row">
            <span data-l10n-id="pdfjs-print-progress-message"></span>
            </div>
            <div class="row">
                <progress value="0" max="100"></progress>
                <span data-l10n-id="pdfjs-print-progress-percent" data-l10n-args='{ "progress": 0 }' class="relative-progress">0%</span>
            </div>
            <div class="buttonRow">
            <button id="printCancel" class="dialogButton" type="button"><span data-l10n-id="pdfjs-print-progress-close-button"></span></button>
            </div>
        </dialog>
    </div>  <!-- dialogContainer -->

      <div id="editorUndoBar" class="messageBar" role="status" aria-labelledby="editorUndoBarMessage" tabindex="-1" hidden>
        <div>
          <div>
            <span id="editorUndoBarMessage" class="description"></span>
          </div>
          <button id="editorUndoBarUndoButton" class="undoButton" type="button" tabindex="0" data-l10n-id="pdfjs-editor-undo-bar-undo-button">
            <span data-l10n-id="pdfjs-editor-undo-bar-undo-button-label"></span>
          </button>
          <button id="editorUndoBarCloseButton" class="closeButton" type="button" tabindex="0" data-l10n-id="pdfjs-editor-undo-bar-close-button">
            <span data-l10n-id="pdfjs-editor-undo-bar-close-button-label"></span>
          </button>
        </div>
      </div> <!-- editorUndoBar -->

</div> <!-- outerContainer -->
<div id="printContainer"></div>
</body>
</html>
