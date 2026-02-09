<?php
if (isset($tmp)) {
    $temp = $tmp;
} else {
    $temp = 'admin';
}
?>
<?= $this->extend('layout/' . config('Vh')->tmp()) ?>

<!-- Start section -->
<?= $this->section('css') ?>
<style>
    .container {
        margin: 5% 3%;

        @media (min-width: $bp-bart) {
            margin: 2%;
        }

        @media (min-width: $bp-homer) {
            margin: 2em auto;
            max-width: $bp-homer;
        }
    }

    .responsive-table {
        width: 100%;
        margin-bottom: 1.5em;
        border-spacing: 0;

        @media (min-width: $bp-bart) {
            font-size: .9em;
        }

        @media (min-width: $bp-marge) {
            font-size: 1em;
        }

        thead {
            // Accessibly hide <thead> on narrow viewports
            position: absolute;
            clip: rect(1px 1px 1px 1px);
            /* IE6, IE7 */
            padding: 0;
            border: 0;
            height: 1px;
            width: 1px;
            overflow: hidden;

            @media (min-width: $bp-bart) {
                // Unhide <thead> on wide viewports
                position: relative;
                clip: auto;
                height: auto;
                width: auto;
                overflow: auto;
            }

            th {
                background-color: rgba(38, 137, 13, 1);
                border: 1px solid rgba(134, 188, 37, 1);
                font-weight: normal;
                text-align: center;
                color: white;

                &:first-of-type {
                    text-align: left;
                }
            }
        }

        // Set these items to display: block for narrow viewports
        tbody,
        tr,
        th,
        td {
            display: block;
            padding: 0;
            text-align: left;
            white-space: normal;
        }

        tr {
            @media (min-width: $bp-bart) {
                // Undo display: block 
                display: table-row;
            }
        }

        th,
        td {
            padding: .5em;
            vertical-align: middle;

            @media (min-width: $bp-lisa) {
                padding: .75em .5em;
            }

            @media (min-width: $bp-bart) {
                // Undo display: block 
                display: table-cell;
                padding: .5em;
            }

            @media (min-width: $bp-marge) {
                padding: .75em .5em;
            }

            @media (min-width: $bp-homer) {
                padding: .75em;
            }
        }

        caption {
            margin-bottom: 1em;
            font-size: 1em;
            font-weight: bold;
            text-align: center;

            @media (min-width: $bp-bart) {
                font-size: 1.5em;
            }
        }

        tfoot {
            font-size: .8em;
            font-style: italic;

            @media (min-width: $bp-marge) {
                font-size: .9em;
            }
        }

        tbody {
            @media (min-width: $bp-bart) {
                // Undo display: block 
                display: table-row-group;
            }

            tr {
                margin-bottom: 1em;

                @media (min-width: $bp-bart) {
                    // Undo display: block 
                    display: table-row;
                    border-width: 1px;
                }

                &:last-of-type {
                    margin-bottom: 0;
                }

                &:nth-of-type(even) {
                    @media (min-width: $bp-bart) {
                        background-color: rgba(0, 0, 0, .12);
                    }
                }
            }

            /* th[scope="row"] {
                background-color: rgba(38, 137, 13, 1);
                color: white;

                @media (min-width: $bp-lisa) {
                    border-left: 1px solid rgba(134, 188, 37, 1);
                    border-bottom: 1px solid rgba(134, 188, 37, 1);
                }

                @media (min-width: $bp-bart) {
                    background-color: transparent;
                    color: rgba(0, 0, 0.87);
                    text-align: left;
                }
            } */

            /* td {
                text-align: right;

                @media (min-width: $bp-bart) {
                    border-left: 1px solid rgba(134, 188, 37, 1);
                    border-bottom: 1px solid rgba(134, 188, 37, 1);
                    text-align: center;
                }

                &:last-of-type {
                    @media (min-width: $bp-bart) {
                        border-right: 1px solid rgba(134, 188, 37, 1);
                    }
                }
            }

            td[data-type=currency] {
                text-align: right;
            }

            td[data-title]:before {
                content: attr(data-title);
                float: left;
                font-size: .8em;
                color: rgba(0, 0, 0, .54);

                @media (min-width: $bp-lisa) {
                    font-size: .9em;
                }

                @media (min-width: $bp-bart) {
                    // Don’t show data-title labels 
                    content: none;
                }
            } */
        }
    }
</style>
<?= $this->endSection() ?>
<!-- End Section -->

<!-- Start Section -->
<?= $this->section('content') ?>
    <div class="card">
        <!-- <div class="card-header">List PDF POMAILER</div> -->
        <div class="card-body">
            <h5 class="card-title">LIST PDF POMAILER</h5>
            <table id="tb_filePdfPomailer" class="display">
                <thead>
                    <tr>
                        <th></th>
                        <th>Filename</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $key => $value) { ?>
                    <tr>
                        <td>
                            <a href="<?=base_url($value)?>" target="_blank">
                                <div class="text-primary">Lihat File <i class="fas fa-external-link-alt ml-2"></i></div>
                            </a>
                        </td>
                        <td><?=$value?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?= $this->endSection() ?>
<!-- End Section -->

<!-- Start Section -->
<?= $this->section('script') ?>
<!-- <script src="<?//= base_url('js/admin/pages/mcp_report/dashboard/index.js?time=' . date('YmdHis')); ?>"></script> -->
<script>
    new DataTable('#tb_filePdfPomailer');
</script>
<?= $this->endSection() ?>
<!-- End Section -->