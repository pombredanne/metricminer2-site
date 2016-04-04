<? include("header.php"); ?>



<div class="row">
    <div class="col-lg-12">
        <h1>Changelog</h1>

        <h2 id="240">2.4.0</h2>

        <ul>
        <li>Commit has isMerge(), which identifies whether that
        commit is a merge.</li>
        </ul>

        <h2 id="230">2.3.0</h2>

        <ul>
        <li>Commit has getBranches(), which returns the list of branches
        that commit belongs to.</li>
        </ul>

        <h2 id="220">2.2.0</h2>

        <ul>
        <li>Modification has getAdded() and getRemoved(), which is the
        number of lines added and removed in that modification.</li>
        </ul>

        
        <h2 id="210">2.1.0</h2>

        <ul>
        <li>fromTheBeginning() option in DSL configuration.</li>
        <li>Improvements in Git integration.</li>
        </ul>

        <h2 id="204">2.0.3</h2>

        <ul>
        <li>SVN support</li>
        <li>.process() does not need a PersistenceMechanism anymore</li>
        </ul>

        <h2 id="202">2.0.2</h2>

        <ul>
        <li>Author and Committer in <i>Commit</i> class (the <i>Committer</i> class was renamed to <i>Developer</i>)</li>
        </ul>

        <h2 id="201">2.0.1</h2>

        <ul>
        <li>No more implementation of code metrics anymore. JDT and ANTLR parsers can still be used, but no implementation of CC, NOM, etc, is provided by the framework</li>
        <li>New commits range: ListOfCommits, Range</li>
        </ul>

        <h2 id="200">2.0.0</h2>

        <ul>
            <li>First release ever! \o/</li>
        </ul>
    </div>
</div>



<? include("footer.php"); ?>