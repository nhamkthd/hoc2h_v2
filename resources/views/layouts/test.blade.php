 <md-toolbar class="md-menu-toolbar">
    <div layout="row">
      <md-toolbar-filler layout layout-align="center center">
        <md-icon md-svg-icon="call:chat"></md-icon>
      </md-toolbar-filler>
      <div>
        <h2 class="md-toolbar-tools">Untitled document</h2>
        <md-menu-bar>
          <md-menu>
            <button ng-click="$mdMenu.open()">
              File
            </button>
            <md-menu-content>
              <md-menu-item>
                <md-button ng-click="ctrl.sampleAction('share', $event)">
                  Share...
                </md-button>
              </md-menu-item>
              <md-menu-divider></md-menu-divider>
              <md-menu-item>
                <md-button ng-click="ctrl.sampleAction('Open', $event)">
                  Open...
                  <span class="md-alt-text"> {{ 'M-O' | keyboardShortcut }}</span>
                </md-button>
              </md-menu-item>
              <md-menu-item>
                <md-button disabled="disabled" ng-click="ctrl.sampleAction('Rename', $event)">
                  Rename
                </md-button>
              </md-menu-item>
              <md-menu-divider></md-menu-divider>
              <md-menu-item>
                <md-button ng-click="ctrl.sampleAction('Print', $event)">
                  Print
                  <span class="md-alt-text">{{ 'M-P' | keyboardShortcut }}</span>
                </md-button>
              </md-menu-item>
            </md-menu-content>
          </md-menu>
          <md-menu>
            <button ng-click="$mdMenu.open()">
              Edit
            </button>
            <md-menu-content>
              <md-menu-item class="md-indent">
                <md-icon md-svg-icon="undo"></md-icon>
                <md-button ng-click="ctrl.sampleAction('undo', $event)">
                  Undo
                  <span class="md-alt-text">{{ 'M-Z' | keyboardShortcut }}</span>
                </md-button>
              </md-menu-item>
              <md-menu-item class="md-indent">
                <md-icon md-svg-icon="redo"></md-icon>
                <md-button ng-click="ctrl.sampleAction('redo', $event)">
                  Redo
                  <span class="md-alt-text">{{ 'M-Y' | keyboardShortcut }}</span>
                </md-button>
              </md-menu-item>
              <md-menu-divider></md-menu-divider>
              <md-menu-item class="md-indent">
                <md-icon md-svg-icon="content-cut"></md-icon>
                <md-button ng-click="ctrl.sampleAction('cut', $event)">
                  Cut
                  <span class="md-alt-text">{{ 'M-X' | keyboardShortcut }}</span>
                </md-button>
              </md-menu-item>
              </md-menu-divider>
              <md-menu-item class="md-indent">
                <md-button ng-click="ctrl.sampleAction('Find and replace', $event)">
                  Find and replace...
                  <span class="md-alt-text">{{ 'M-S-H' | keyboardShortcut }}</span>
                </md-button>
              </md-menu-item>
            </md-menu-content>
          </md-menu>
          <md-menu>
            <button ng-click="$mdMenu.open()">
              View
            </button>
            <md-menu-content>
              <md-menu-item type="checkbox" ng-model="ctrl.settings.printLayout">Print layout</md-menu-item>
              <md-menu-item class="md-indent">
                <md-menu>
                  <md-button ng-click="$mdMenu.open()">Mode</md-button>
                  <md-menu-content width="3">
                    <md-menu-item type="radio" ng-model="ctrl.settings.presentationMode" value="'presentation'">Presentation</md-menu-item>
                    <md-menu-item type="radio" ng-model="ctrl.settings.presentationMode" value="'edit'">Edit</md-menu-item>
                    <md-menu-item type="radio" ng-model="ctrl.settings.presentationMode" value="'modifiable'">Modifiable</md-menu-item>
                  </md-menu-content>
                </md-menu>
              </md-menu-item>
              <md-menu-divider></md-menu-divider>
              <md-menu-item type="checkbox" ng-model="ctrl.settings.showRuler">Show ruler</md-menu-item>
              <md-menu-item type="checkbox" ng-model="ctrl.settings.showEquationToolbar">Show equation toolbar</md-menu-item>
              <md-menu-item type="checkbox" ng-model="ctrl.settings.showSpellingSuggestions">Show spelling suggestions</md-menu-item>
              <md-menu-divider></md-menu-divider>
              <md-menu-item type="checkbox" ng-model="ctrl.settings.compactControls">Compact controls</md-menu-item>
              <md-menu-item type="checkbox" ng-model="ctrl.settings.fullScreen">Full screen</md-menu-item>
            </md-menu-content>
          </md-menu>
        </md-menu-bar>
      </div>
    </div>
  </md-toolbar>