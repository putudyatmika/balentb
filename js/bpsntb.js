 $(document).ready(function(){

    // hide #back-top first
    $("#back-top").hide();

    // fade in #back-top
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 80) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        });

        // scroll body to 0px on click
        $('#back-top a').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 500);
            return false;
        });
    });

});

$(document).ready(function() {
	$('a[data-confirm]').click(function(ev) {
		var href = $(this).attr('href');
		if (!$('#dataConfirmModal').length) {
			$('body').append('<div id="dataConfirmModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dataConfirmModal" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="dataConfirmLabel">Konfirmasi</h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn btn-success" data-dismiss="modal" aria-hidden="true">close</button><a class="btn btn-primary" id="dataConfirmOK"><span class="glyphicon glyphicon-ok"></span> ok</a></div></div></div></div>');
		}
		$('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
		$('#dataConfirmOK').attr('href', href);
		$('#dataConfirmModal').modal({show:true});
		return false;
	});
});

$(document).ready(function() {
	$('#submit_menu[data-confirm]').click(function(ev) {
		ev.preventDefault();
		if (!$('#dataConfirmModal').length) {
			$('body').append('<div id="dataConfirmModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dataConfirmModal" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="dataConfirmLabel">Konfirmasi</h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn btn-success" data-dismiss="modal" aria-hidden="true">close</button><a class="btn btn-danger" id="dataConfirmOK"><span class="glyphicon glyphicon-trash"></span> submit</a></div></div></div></div>');
		}
		$('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
		$('#dataConfirmOK').click(function() {
				$('formProduk').serialize(),
			  $('#produk_check').submit();
		});
		$('#dataConfirmModal').modal({show:true});
		return false;
	});
});

$(document).ready(function() {
    $('#pilihsemua').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.pilih').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"
            });
        }else{
            $('.pilih').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"
            });
        }
    });

});

$(document).ready(function() {
    $('#formKirimPesan').bootstrapValidator({
        message: 'This value is not valid',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            kontak_nama: {
                validators: {
                    notEmpty: {
                        message: 'Silakan isikan nama'
                    },
                    stringLength: {
                        min: 4,
                        max: 30,
                        message: 'minimal 4 huruf dan maximal 30 huruf'
                    }
                }
            },
			kontak_email: {
                validators: {
                    notEmpty: {
                        message: 'silakan isikan alamat email'
                    },
                    emailAddress: {
                        message: 'alamat email tidak valid'
                    }
                }
            },
			kontak_subyek: {
                validators: {
                    notEmpty: {
                        message: 'Silakan isikan judul pesan'
                    },
                    stringLength: {
                        min: 4,
                        max: 50,
                        message: 'minimal 4 huruf dan maximal 50 huruf'
                    }
                }
            },
			kontak_pesan: {
                validators: {
                    notEmpty: {
                        message: 'Silakan isikan pesan'
                    }
                }
            },
			kontak_kode: {
                validators: {
                    notEmpty: {
                        message: 'Silakan isikan kode pengaman'
                    },
					numeric: {
						message: 'isian harus berupa angka'
						}
                }
            }
        }
    });
});
$(document).ready(function() {
    $('#formUnitKerja').bootstrapValidator({
        message: 'Nilai tidak valid',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            unit_kode: {
                validators: {
                    notEmpty: {
                        message: 'Silakan isikan kode'
                    },
					numeric: {
						message: 'isian harus berupa angka'
					},
                    stringLength: {
                        min: 5,
                        max: 5,
                        message: 'harus lima digit angka'
                    }
                }
            },
			unit_nama: {
                validators: {
                    notEmpty: {
                        message: 'Silakan isikan nama unit'
                    },
                    stringLength: {
                        min: 10,
                        max: 100,
                        message: 'minimal 10 huruf'
                    }
                }
            },
      unit_jenis: {
                validators: {
                    notEmpty: {
                        message: 'Silakan pilih unit jenis'
                    }
                }
            },
			unit_eselon: {
                validators: {
                    notEmpty: {
                        message: 'Silakan pilih unit eselon'
                    }
                }
            }
        }
    });
});
$(document).ready(function() {
    $('#formAddPegawaiAbsen').bootstrapValidator({
        message: 'Nilai tidak valid',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            peg_id: {
                validators: {
                    notEmpty: {
                        message: 'Silakan isikan ID Pegawai di Mesin'
                    },
					numeric: {
						message: 'isian harus berupa angka'
					}
                }
            },
			peg_nama: {
                validators: {
                    notEmpty: {
                        message: 'Silakan isikan nama lengkap'
                    },
                    stringLength: {
                        min: 4,
                        max: 100,
                        message: 'minimal 4 huruf'
                    }
                }
            },
			peg_jk: {
                validators: {
                    notEmpty: {
                        message: 'Silakan pilih jenis kelamin'
                    }
                }
            },
            peg_status: {
            validators: {
                notEmpty: {
                    message: 'Silakan pilih status absen pegawai'
                      }
                  }
            }
        }
    });
});

$(document).ready(function() {
    $('#formAddUser').bootstrapValidator({
        message: 'Nilai tidak valid',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          user_id: {
                validators: {
                    notEmpty: {
                        message: 'Silakan isikan user ID'
                    },
                    stringLength: {
                        min: 3,
                        max: 20,
                        message: 'minimal 3 huruf'
                    }
                }
            },
            user_nama: {
                validators: {
                    notEmpty: {
                        message: 'Silakan isikan nama user'
                    },
                    stringLength: {
                        min: 3,
                        max: 200,
                        message: 'minimal 3 huruf'
                    }
                }
            },
            user_email: {
                validators: {
                    notEmpty: {
                        message: 'Silakan isikan email user'
                    },
                    emailAddress: {
                        message: 'alamat email tidak valid'
                    }
                }
            },
            user_passwd: {
                  validators: {
                      notEmpty: {
                          message: 'Silakan isikan password'
                      },
                      stringLength: {
                          min: 4,
                          message: 'minimal 4 huruf'
                      },
                      identical: {
                        field: 'user_passwd2',
                        message: 'password tidak sama dengan konfirmasi password'
                    }
                  }
              },
              user_passwd2: {
                    validators: {
                        notEmpty: {
                            message: 'Silakan isikan konfirmasi password'
                        },
                        stringLength: {
                            min: 4,
                            message: 'minimal 4 huruf'
                        },
                        identical: {
                          field: 'user_passwd',
                          message: 'konfirmasi password tidak sama dengan password'
                      }
                    }
                },
            user_unitkerja: {
                      validators: {
                          notEmpty: {
                              message: 'Silakan pilih unitkerja user'
                          }
                      }
                  },
                  user_level: {
                            validators: {
                                notEmpty: {
                                    message: 'Silakan pilih level user'
                                }
                            }
                        },
			    user_status: {
                validators: {
                    notEmpty: {
                        message: 'Silakan pilih status user'
                    }
                }
            }
        }
    });
});
$(document).ready(function() {
    $('#formKegBaru').bootstrapValidator({
        message: 'Nilai tidak valid',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          keg_nama: {
                    validators: {
                        notEmpty: {
                            message: 'Silakan isikan kegiatan lengkap'
                        },
                        stringLength: {
                            min: 10,
                            max: 254,
                            message: 'minimal 10 huruf'
                        }
                    }
                },
                keg_unitkerja: {
                          validators: {
                              notEmpty: {
                                  message: 'Silakan pilih unit kerja kegiatan'
                              }
                          }
                      },
                      keg_jenis: {
                                validators: {
                                    notEmpty: {
                                        message: 'Silakan pilih jenis kegiatan'
                                    }
                                }
                            },
                            keg_tglmulai: {
                                      validators: {
                                          notEmpty: {
                                              message: 'Silakan isi tgl mulai'
                                            },
                                            date: {
                                             format: 'YYYY-MM-DD',
                                             message: 'format YYYY-MM-DD'
                                         }
                                            }
                                      },
                                      keg_tglakhir: {
                                                validators: {
                                                    notEmpty: {
                                                        message: 'Silakan isi tgl berakhir'
                                                      },
                                                      date: {
                                                       format: 'YYYY-MM-DD',
                                                       message: 'format YYYY-MM-DD'
                                                   }
                                                      }
                                                },
                                                keg_satuan: {
                                                          validators: {
                                                              notEmpty: {
                                                                  message: 'Silakan isi satuan kegiatan'
                                                              }
                                                          }
                                                      },
            keg_target: {
                validators: {
                    notEmpty: {
                        message: 'Silakan isikan total target'
                    },
					numeric: {
						message: 'isian harus berupa angka'
					},
                    stringLength: {
                        min: 1,
                        max: 10,
                        message: 'minimal 1 digit angka'
                    }
                }
            },
            keg_spj: {
                          validators: {
                              notEmpty: {
                                  message: 'Silakan pilih laporan SPJ ke Provinsi'
                              }
                          }
                      },
            'keg_kabkota[]' : {
                      validators: {
                          notEmpty: {
                              message: 'Silakan isi target kabkota'
                          }
                      }
                  }
        }
    });
});
$(document).ready(function() {
    $('#formGantiPasswd').bootstrapValidator({
        message: 'Nilai tidak valid',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          user_pass_lama: {
              validators: {
                  notEmpty: {
                      message: 'Silakan isikan password'
                  },
                  stringLength: {
                      min: 4,
                      message: 'minimal 4 huruf'
                  }
              }
          },
              user_pass_baru: {
                  validators: {
                      notEmpty: {
                          message: 'Silakan isikan password'
                      },
                      stringLength: {
                          min: 4,
                          message: 'minimal 4 huruf'
                      },
                      identical: {
                        field: 'user_pass_baru2',
                        message: 'password tidak sama dengan konfirmasi password baru'
                    }
                  }
              },
              user_pass_baru2: {
                    validators: {
                        notEmpty: {
                            message: 'Silakan isikan konfirmasi password'
                        },
                        stringLength: {
                            min: 4,
                            message: 'minimal 4 huruf'
                        },
                        identical: {
                          field: 'user_pass_baru',
                          message: 'konfirmasi password tidak sama dengan password baru'
                      }
                    }
                }
        }
    });
});
$(document).ready(function() {
    $('#formKirimTarget').bootstrapValidator({
        message: 'Nilai tidak valid',
       feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            keg_d_tgl: {
                validators: {
                    notEmpty: {
                        message: 'Silakan isi tanggal'
                    }
                }
            },
            keg_d_jumlah: {
                validators: {
                    notEmpty: {
                        message: 'Silakan isikan jumlah'
                    },
                    numeric: {
                        message: 'isian harus berupa angka'
                    }
                }
            },
      keg_d_ket: {
                validators: {
                    notEmpty: {
                        message: 'Silakan isi dikirim melalui apa'
                    }
                }
            }
        }
    });
});