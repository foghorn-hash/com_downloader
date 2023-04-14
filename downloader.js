/*
 * Ext JS Library 2.2
 * Copyright(c) 2006-2010, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 */

/**/
Ext.BLANK_IMAGE_URL = '/components/com_downloader/ext/resources/images/default/s.gif';

Ext.onReady(function() {
	
	        Ext.QuickTips.init();	
			
			var storechart = new Ext.data.Store ({
				proxy: new Ext.data.HttpProxy ({ 
					url: 'downloads.php',
					scope: this
				})
				, baseParams: {
					task: "downloads", "month": 01, "year": 2010 }
				, reader: new Ext.data.JsonReader ({
					id: 'name'
					, fields: [
						{name: 'name'}
						, {name: 'downloads', type:'float'}
						, {name: 'total', type:'float'}
					]
				})
			});		
				
	    storechart.load();
	
	// more complex with a custom look
    chart = new Ext.Panel({
		//renderTo: 'ChartID',
        iconCls:'chart',
        border: false,
		frame: false,
        width:'100%',
        height:200,
        layout:'fit',
        region:'center',
        items: {
            xtype: 'columnchart',
            store: storechart,
            url:'/components/com_downloader/ext/resources/charts.swf',
            xField: 'name',
            yAxis: new Ext.chart.NumericAxis({
                displayName: 'Downloads',
                labelRenderer : Ext.util.Format.numberRenderer('0')
            }),
            tipRenderer : function(chart, record, index, series){  
				
                    return record.data.downloads + ' downloads at ' + record.data.name;		        
            },
            chartStyle: {
                padding: 10,
                animationEnabled: true,
                font: {
                    name: 'Tahoma',
                    color: 0x444444,
                    size: 11
                },
                dataTip: {
                    padding: 5,
                    border: {
                        color: 0x99bbe8,
                        size:1
                    },
                    background: {
                        color: 0xDAE7F6,
                        alpha: .9
                    },
                    font: {
                        name: 'Tahoma',
                        color: 0x15428B,
                        size: 10,
                        bold: true
                    }
                },
                xAxis: {
                    color: 0x69aBc8,
                    majorTicks: {color: 0x69aBc8, length: 4},
                    minorTicks: {color: 0x69aBc8, length: 2},
                    majorGridLines: {size: 1, color: 0xeeeeee}
                },
                yAxis: {
                    color: 0x69aBc8,
                    majorTicks: {color: 0x69aBc8, length: 4},
                    minorTicks: {color: 0x69aBc8, length: 2},
                    majorGridLines: {size: 1, color: 0xdfe8f6}
                }
            },
            series: [{
                type: 'column',		
                displayName: 'Downloads',
                yField: 'downloads',
                style: {
                    //image:'bar.gif',
                    mode: 'stretch',
                    color:0x99BBE8
                }
            }]
        }
    });

    var fs = new Ext.FormPanel({
		id:'formpanel',
		//renderTo: 'StudioID',
        labelAlign: 'top',
        bodyStyle:'padding:5px',
		region: 'north',
		border:false,
		frame:false,
        height: 380,
		buttonAlign: 'left',
        items: [{
            layout:'column',
            border:false,
            items:[{
                columnWidth:.50,
                layout: 'form',
                border:false,
                items: [{
                    xtype:'textfield',
                    fieldLabel: 'Firstname*',
                    name: 'first',
                    anchor:'95%',
					allowBlank: false
                },{
                    xtype:'textfield',
                    fieldLabel: 'Lastname*',
                    name: 'last',
                    anchor:'95%',
					allowBlank: false
                },{
                    xtype:'textfield',
                    fieldLabel: 'Company/Organization*',
                    name: 'company',
                    anchor:'95%',
					allowBlank: false,
					emptyText: 'Company Pty Ltd'
                },{
                    xtype:'textfield',
                    fieldLabel: 'Email*',
                    name: 'email',
                    vtype:'email',
                    anchor:'95%',
					allowBlank: false,
					emptyText: 'firstname.lastname@company.com'
                }, {

                        xtype: 'recaptcha'

                    ,    name: 'recaptcha'

                    ,    id: 'recaptcha'

                    ,    publickey: '6LfBxwoAAAAAAIpgfy9p6wkXpHFdBabtfzqgNiYY'

                    ,    theme: 'white'

                    ,    lang: 'en'

                }]
            }]
         
        }],
		buttons: [{
            text: 'Download',
			handler: function(){
            fs.getForm().submit({
								  url:'submit.php', 
								  waitMsg:'Downloading...',
								  success: function (form, action){
									fs.getForm().reset();
									window.location = "download.php";
									//storechart.reload();
					                //storechart.loadData();
									},
									failure: function (form, action){	
									var json = Ext.util.JSON.decode(action.response.responseText);
									Ext.MessageBox.alert('Failure',json.msg);
									}
								  });
        	}
        },{
            text: 'Reset',
			handler: function(){
            fs.getForm().reset();
        	}
        }]

    });
	
    var tabs = new Ext.TabPanel({
        renderTo: 'StudioID',
        width:450,
		height:400,
        activeTab: 0,
        frame:true,
        defaults:{autoHeight: true},
        items:[chart,
            fs
        ]
    });



}); 
